<?php include "template/header_unlogin.php"; ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-8 col-md-8 col-12 justify-content-center mb-3">
            <div style="background-color: white; border-radius: 10px; box-shadow: 5px 10px 20px 5px rgba(0, 0, 0, 0.1); width: 100%; padding-top: 3rem; padding-bottom: 3rem;">
                <div id="imageCarousel" class="carousel slide" data-ride="carousel" data-interval="1500">
                    <div class="carousel-inner text-center">
                        <div class="carousel-item active">
                            <img src="http://localhost/antriyuk/node_module/assets/gmb2.png" class="mb-2 img-thumbnail" style="width: 100%; height: 400px; object-fit: cover;" />
                        </div>
                        <div class="carousel-item">
                            <img src="http://localhost/antriyuk/node_module/assets/gmb1.png" class="mb-2 img-thumbnail" style="width: 100%; height: 400px; object-fit: cover;" />
                        </div>
                        <div class="carousel-item">
                            <img src="http://localhost/antriyuk/node_module/assets/gmb4.png" class="mb-2 img-thumbnail" style="width: 100%; height: 400px; object-fit: cover;" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-12 mb-3">
            <div style="width: 100%; height: 100%; background-color: white; box-shadow: 5px 10px 20px 5px rgba(0, 0, 0, 0.1); color: #123545; padding: 5rem 5rem;">
                <div class="text-center">
                    <b><span style="font-size: 2em;">antriyuk</span></b><br> | Admin Access |
                    <hr style="width: 60%; background-color: white;">
                </div>
                <br>
                <form action="proses_login.php" method="post">
                    <input type="text" name="username" placeholder="Username" class="form-control" />
                    <br>
                    <input type="password" name="password" placeholder="Password" class="form-control" />
                    <br>
                    <div class="text-center">
                        <b><input type="submit" value="Masuk" class="btn btn-primary submit-button"></b>
                    </div>
                </form>
                <br>
                <div class="text-center">
                    <a href="http://localhost/antriyuk/client_side/index.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
