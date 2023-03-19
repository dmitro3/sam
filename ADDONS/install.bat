@echo off

call pm2 delete 0
call node -v
call node Game2.js
call  pm2 ls
call  npm install -g ws
call npm install -g request
call npm install pm2 -g
call pm2 ls
cd C:\OSPanel\domains\localhost\PTWebSocket
call pm2 start Server.js
call pm2 start Slots.js
call pm2 start Arcade.js
