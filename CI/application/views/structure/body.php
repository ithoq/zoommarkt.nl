<body> 
    <!-- start main screen -->
    <div class="wrapper"> 
        <?php $this->load->view('templates/header'); ?>
        <div class="row collapse">
            <div class="small-12 columns">   
                <?php $this->load->view($view_main); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
</body>