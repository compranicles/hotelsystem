<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!--<div>
      Confirm the reservation of ?
      <form action="" method="post">
        <button type="button" class="btn btn-primary">Confirm</button>
        <button type="button" class="btn btn-light">Reject</button>
      </form>
    </div>-->

    

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <video id="preview"></video>
        </div>
        <?php if (isset($checkMessage)) {?>
    <div class="alert alert-success col-md-6" role="alert">
      <?= $checkMessage; ?>
    </div>
    <?php } ?>
        </div>
      </div>
    </div>

    <script>
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      Instascan.Camera.getCameras().then(function(cameras) {
        if(cameras.length > 0) {
          scanner.start(cameras[0]);
        }else {
          alert('No cameras found');
        }

      }).catch(function(e){
        console.error(e);
      });

      scanner.addListener('scan', function(c){
        //document.getElementById('text').value=c;
        //document.forms[0].target = "_blank";
        //document.forms[0].submit(); ///triggered when scanned; get value from input
        //window.open(base_url().'/customercheck/'.c, "_blank");
        console.log(c);
        var url = "/customercheck/confirm/";
//not fixed
        $.ajax({
            type: "POST",
            url: url,
            //dataType: "json",
            data: c,
            success: function(result) {
                window.location = result;
            }
        });
        //window.location.href = url;

      });


    </script>
</body>
</html>