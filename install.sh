#write out current crontab
crontab -l > sms
#echo new cron into cron file
echo "@reboot php /app/server/sms-on-boot.php > /dev/null 2>&1" >> sms
echo "*/2 * * * * php /app/server/server.php > /dev/null 2>&1" >> sms 
#install new cron file
crontab sms
rm sms