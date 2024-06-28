<!-- Masthead-->
<header class="masthead">
    <div data-aos="fade-up" class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h3 style="font-size: 30px;" class="text-white">About Us</h3>
                <hr class="divider my-4 mx-auto" />
            </div>

        </div>
    </div>
</header>

<section data-aos="fade-up" class="page-section">
    <div class="container">
        <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>

    </div>
</section>