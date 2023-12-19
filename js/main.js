
// function sendData(){
//     let pseudo = document.getElementById("pseudo").value;
//     let content = document.getElementById("content").value;
//     let dateTime = document.getElementById("dateTime").value;
//     let ip_adress = document.getElementById("ip_adress").value;
//         $.ajax({
//             type: 'post',
//             url: 'PHP-PDO/Vanilla-TP-MiniChat/process/newMessage-to-db.php',
//             data: {
//                 'pseudo':pseudo,
//                 'content':content,
//                 'dateTime':dateTime,
//                 'ip_adress':ip_adress
//             },
//             success: function (response) {
//             // $('#res').html("Vos données seront sauvegardées");
//             }
//         });
    
//   return false;
// }

// const button = document.querySelector('#submit');
// button.addEventListener('click', () => {
//     alert('bonjour');
// });

$('#submit').on('click', function(){
    $.ajax({
        type:'post',
        url:'process/newMessage-to-db.php',
        data: $('#message_form').serialize(),
        success : function(response){
            response

        },
        error: function(){
            alert('error')
        }
   })
})


// function autoRefresh_div() {
//     $(".chatWindow").load("load.html", function() {
//         setInterval(autoRefresh_div, 3000);
//     });
// }
// autoRefresh_div();