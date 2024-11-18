const { Telegraf } = require('telegraf');
const axios = require('axios');
const schedule = require('node-schedule');
const bot = new Telegraf('5809069730:AAGS863zIrKnxEdhD-lp8XC-_8FquwLAK1k');

const web_url = 'https://perpustakaan-smansatop.my.id';
const id_admin = '1378945171';

console.log('SERVER NOTIF TELEGRAM AKTIF');
bot.start((ctc) => {
    let from = ctc['update']['message']['chat'];
    ctc.reply(`SELAMAT DATANG ${from['first_name']} ${from['last_name']} DI BOT PERPUSTAKAAN.\nID Telegram Anda : ${from['id']}`)
});

bot.command('/notif', async (ctc)=>{
    sendNotif()
    await ctc.telegram.sendMessage(id_admin, `Notif Terkirim`);
});
async function sendNotif() {
    try {
        const response = await axios.get(`${web_url}/notif`);
        console.log(`Notif Berhasil Terkirim`);
    } catch (error) {
        console.error(error);
    }
}

schedule.scheduleJob('22 * * * *', function(){
  sendNotif();
  // console.log('The answer to life, the universe, and everything!');
});

bot.launch();



// *    *    *    *    *    *
// ┬    ┬    ┬    ┬    ┬    ┬
// │    │    │    │    │    │
// │    │    │    │    │    └ day of week (0 - 7) (0 or 7 is Sun)
// │    │    │    │    └───── month (1 - 12)
// │    │    │    └────────── day of month (1 - 31)
// │    │    └─────────────── hour (0 - 23)
// │    └──────────────────── minute (0 - 59)
// └───────────────────────── second (0 - 59, OPTIONAL)
