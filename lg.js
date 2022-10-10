$(function(){
    //alert("Hi 1");
        var frm = $('#lg');

        frm.submit(function (e) {
    
            e.preventDefault();
            var uname = document.getElementById('username').value;
            var pass = document.getElementById('password').value;
            var url="" ;
            $.ajax({
                url: 'lg.php',
                method: 'POST',
                dataType: 'JSON',
                data: {'pass': pass , 'uname':uname},
                success: function (data) {
                    document.getElementById("resp").innerHTML = data.reply;
                    if(data.reply == "Login success"){

                        window.location.href = "admin.php?uname="+uname;
                    }
                    else{
                        console.log("LOL no");
                    }
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        });
        
})