<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    html {
        height: 100%;
    }
    
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    #footer-wrapper {
        margin-left: 250px;
        width: calc(100% - 250px);
        margin-top: auto;
    }

    footer {
        width: 100%;
        background-color: #343a40;
    }

    @media (max-width: 768px) {
        #footer-wrapper {
            margin-left: 0;
            width: 100%;
        }
    }
</style>

<div id="footer-wrapper">
    <footer class="bg-dark text-white py-4 shadow">
        <div class="container-fluid px-4">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p class="small">We are dedicated to managing and facilitating blood donations to save lives. Our system ensures efficient blood bank management and donor coordination.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php?page=home" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="index.php?page=donors" class="text-white text-decoration-none">Donors</a></li>
                        <li><a href="index.php?page=donations" class="text-white text-decoration-none">Blood Donations</a></li>
                        <li><a href="index.php?page=requests" class="text-white text-decoration-none">Blood Requests</a></li>
                        <li><a href="index.php?page=handedover" class="text-white text-decoration-none">Handed Over</a></li>
                        <li><a href="index.php?page=users" class="text-white text-decoration-none">Users</a></li>
                    </ul>
                </div>
                <!-- Social Media -->
                <div class="col-md-4 mb-3">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"> Facebook</i></a><br>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"> Twitter</i></a><br>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"> Linkedin</i></a><br>
                    <a href="#" class="text-white me-3"><i class="bi bi-github"> Github</i></a>

                </div>
            </div>
            <!-- Copyright -->
            <div class="text-center mt-3">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Blood Bank Management System. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</div>