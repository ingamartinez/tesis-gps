
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


Echo.channel('rfid')
    // .listen('MostrarRfid', (e) => {
    //     console.log(e);
    //
    // })
    .listen('CapturarRfid', (e) => {
    console.log(e);
    toastr.success('El ID de la tarjeta es '+e.tarjeta, 'Tarjeta');
});