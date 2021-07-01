<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <!--<div>
      Confirm the reservation of ?
      <form action="" method="post">
        <button type="button" class="btn btn-primary">Confirm</button>
        <button type="button" class="btn btn-light">Reject</button>
      </form>
    </div>-->
    <?php $session = \Config\Services::session(); ?>

    <?php if ($session->getTempdata('success')): ?>
    <div class="alert alert-success" role="alert">
      <?= $session->getTempdata('success'); ?>
    </div>
    <?php endif; ?>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <video id="preview"></video>
        </div>
        <div class="col-md-6">

        <div id="qrform">
        <?= form_open(base_url().'/qrscanner'); ?>
        <form action="/">
          <label for="">Scan QR Code</label>
          <input type="text" name="text" id="text" readonyy="" placeholder="Scan QR Code" class="form-control">
        </form>
        <?= form_close(); ?>
        </div>

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
        document.getElementById('text').value=c;
        document.forms[0].submit(); ///triggered when scanned; get value from input
      });


    </script>
</body>
</html>