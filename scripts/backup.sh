#!/bin/bash

# Database credentials and confuguration
DB_USER="root"
DB_PASSWORD=""
DB_NAME="wm_bd"
BACKUP_DIR="/opt/lampp/htdocs/wallmart_data/backups"

# Current date to append to filename
DATE=$(date +"%Y%m%d%H%M%S")
BACKUP_FILE="$BACKUP_DIR/$DB_NAME-$DATE.sql"

# Create output directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Backup command
mysqldump -u $DB_USER -p$DB_PASSWORD --socket=/opt/lampp/var/mysql/mysql.sock $DB_NAME > $BACKUP_FILE

# Check if backup was successful or not
if [ $? -eq 0 ]; then
    echo "Backup completed successfully! $BACKUP_FILE"
else
    echo "Failed to backup database!"
fi
