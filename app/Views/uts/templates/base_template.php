<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Pemrograman Web 3</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>static/css/bootstrap.min.css">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>static/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                            <div class="text-secondary fw-bold fs-3">Menu</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        <div class="row mb-1">
                            <a href="/prodi" class="btn btn-info btn-block">Program Studi</a>
                        </div>
                        <div class="row mb-1">
                            <a href="/mahasiswa" class="btn btn-warning btn-block">Mahasiswa</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <?= $this->renderSection('jscustom') ?>
</body>
</html>
