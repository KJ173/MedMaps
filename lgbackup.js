$(function(){
    alert("Hi 1");
    $('#lg').on('submit', function(e){
        alert("Hi 2");
        //alert(typeof(e));
        var form = $(this);
        e.preventDefault();
        var uname = document.getElementById('username').value;
        var pass = document.getElementById('password').value;
        //var pass = sha256(pass);
        //var pass = MD5(pass);
                            $.ajax({
                                url: 'lg.php',
                                method: 'POST',
                                dataType: 'JSON',
                                data: {'pass': pass , 'uname':uname},
                                success: function(data) {
                                document.getElementById("resp").innerHTML = data.reply;
                                if(data.reply == "Login success"){
                                    window.location.href = "main.php";
                                }
                                else{
                                    console.log("LOL no");
                                }
                                }
                                
                            });
                        });
})