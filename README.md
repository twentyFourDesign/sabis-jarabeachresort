# PHP App Deployment

This repository contains the source code and CI/CD pipeline configuration for deploying a PHP application to a DigitalOcean Droplet.

## Overview

This project automates the deployment of a PHP application to a DigitalOcean Droplet using GitHub Actions.

## Prerequisites

- A DigitalOcean Droplet with a LAMP stack (Linux, Apache, MySQL, PHP) installed.
- SSH access to the Droplet.
- A GitHub account.
- Git installed on your local machine.

## Setup Instructions

### Clone the Repository

```bash
git clone https://github.com/twentyFourDesign/sabis-jarabeachresort.git
cd sabis-jarabeachresort
```
### Configure Secrets

1. Go to your GitHub repository.
2. Navigate to Settings -> Secrets and variables -> Actions.
3. Add the following secrets:
  - DO_SSH_KEY: Your SSH private key for accessing the DigitalOcean Droplet.
  - SUDO_PASSWORD: The password for the sabis user on the Droplet.
    
### Running the Workflow
1. Push changes to the main or master branch.
2. The GitHub Actions workflow will automatically run and deploy the changes to the Droplet.

### Directory Structure

1. .github/workflows: Contains the GitHub Actions workflow configuration.
2. app: Contains the PHP application code.
3. database: Contains database-related file.

