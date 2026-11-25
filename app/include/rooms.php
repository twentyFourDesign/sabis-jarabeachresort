<?php
/*
 * Room list for the "Select your room" step, taken from the Jara booking system
 * (the same rooms guests book on booking.jarabeachresort.com).
 *
 * The list is cached for 10 minutes. If the booking system can't be reached,
 * the last saved list is used; if there is none, it falls back to the old
 * "Room 1 ... Room N" list (N = Number of Tables in Settings).
 */

define('JARA_ROOMS_URL', 'https://booking.jarabeachresort.com/new/api/v1/main/rooms/sub/get/all');
define('JARA_ROOMS_CACHE', rtrim(sys_get_temp_dir(), '/') . '/sabis_jara_rooms.json');
define('JARA_ROOMS_CACHE_SECONDS', 600);

function jara_fetch_rooms_json() {
    if (function_exists('curl_init')) {
        $ch = curl_init(JARA_ROOMS_URL);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTPHEADER => array('Accept: application/json'),
        ));
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($body !== false && $code == 200) ? $body : false;
    }
    $ctx = stream_context_create(array('http' => array('timeout' => 5, 'header' => "Accept: application/json\r\n")));
    return @file_get_contents(JARA_ROOMS_URL, false, $ctx);
}

/* Turn the booking-system response into [ ['type' => 'Family Room', 'title' => 'Family Room 6'], ... ] */
function jara_parse_rooms($json) {
    $data = json_decode($json, true);
    if (!is_array($data)) return array();
    $rooms = array();
    foreach ($data as $sub) {
        $title = isset($sub['title']) ? trim($sub['title']) : '';
        if ($title === '') continue;
        $type = (isset($sub['roomId']) && is_array($sub['roomId']) && !empty($sub['roomId']['title'])) ? trim($sub['roomId']['title']) : 'Rooms';
        $rooms[$title] = array('type' => $type, 'title' => $title);
    }
    $rooms = array_values($rooms);
    usort($rooms, function ($a, $b) {
        $t = strnatcasecmp($a['type'], $b['type']);
        return $t !== 0 ? $t : strnatcasecmp($a['title'], $b['title']);
    });
    return $rooms;
}

function jara_rooms($fallbackCount = 0) {
    $cacheFresh = is_file(JARA_ROOMS_CACHE) && (time() - filemtime(JARA_ROOMS_CACHE) < JARA_ROOMS_CACHE_SECONDS);
    if ($cacheFresh) {
        $rooms = jara_parse_rooms(file_get_contents(JARA_ROOMS_CACHE));
        if (count($rooms) > 0) return $rooms;
    }
    $json = jara_fetch_rooms_json();
    if ($json !== false) {
        $rooms = jara_parse_rooms($json);
        if (count($rooms) > 0) {
            @file_put_contents(JARA_ROOMS_CACHE, $json, LOCK_EX);
            return $rooms;
        }
    }
    // Booking system unreachable: use the last saved list, even if old.
    if (is_file(JARA_ROOMS_CACHE)) {
        $rooms = jara_parse_rooms(file_get_contents(JARA_ROOMS_CACHE));
        if (count($rooms) > 0) return $rooms;
    }
    $rooms = array();
    for ($d = 1; $d <= intval($fallbackCount); $d++) {
        $rooms[] = array('type' => 'Rooms', 'title' => 'Room ' . $d);
    }
    return $rooms;
}

/*
 * Order PINs are saved against "Room 1", "Room 2", ... (Admin > Item Pin).
 * For a booking-system name like "Garden Room 18", use the PIN saved for "Room 18".
 */
function jara_pin_room_key($room) {
    if (preg_match('/(\d+)\s*$/', $room, $m)) return 'Room ' . intval($m[1]);
    return $room;
}

/* Keep only real room names (and "Day Pass") from what the browser sent. */
function jara_clean_selection($selected, $fallbackCount = 0) {
    $allowed = array('Day Pass' => true);
    foreach (jara_rooms($fallbackCount) as $r) { $allowed[$r['title']] = true; }
    $clean = array();
    foreach ((array)$selected as $s) {
        $s = trim((string)$s);
        if (isset($allowed[$s]) && !in_array($s, $clean, true)) $clean[] = $s;
    }
    return $clean;
}
