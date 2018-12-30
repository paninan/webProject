<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('include/head.php')?>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <?php $this->load->view('include/nav.php');?>
    </nav>
  </header>

  <main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item">
          <img class="first-slide" src="https://mekoclinic.com/wp-content/uploads/2016/12/image003.jpg"
            alt="First slide">
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>บริการเสริมความงาม</h1>
              <p>ราคาไม่แพง เมื่อเทียบกับฝีมือ และประสบการณ์ของอาจารย์ และทีมงาน</p>
              
            </div>
          </div>
        </div>
        <div class="carousel-item active">
          <img class="second-slide" src="https://premierclinicthailand.com/wp-content/uploads/2018/08/cover-PM-Clinic-2-8-2018-02-1.jpg"
            alt="Second slide">
          
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="https://promotions.co.th/wp-content/uploads/nath_header.jpg"
            alt="Third slide">
          <div class="container">
           
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <!-- Marketing messaging and featurettes
================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="rounded-circle" src="https://marketplace.canva.com/MAB7mauz6OQ/1/thumbnail_large/canva-cartoon-female-eyes-beauty-icon-MAB7mauz6OQ.png"
            alt="Generic placeholder image" width="140" height="140">
          <h2>ประสบการณ์ 20+ ปี</h2>
          <p>ร้านเราเปิดเป็น ร้านแรกในยูเนี่ยนมอลล์ ที่ให้บริการด้านความงาม อาทิ สักคิ้วโหวงเฮัง, สักปากชมพู ต่อขนตา เป็นต้น คือ เปิดมาพร้อมๆ กับห้าง ดังนั้นเราสั่งสมประสบการณ์มาพอตัว ลูกค้าของเราไม่ต้องมาเสี่ยงกับช่างที่เพิ่งเรียนจบมาใหม่ๆ แล้วเอาคุณมาเป็นหุ่นฝึกฝีมือDonec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies
            </p>
          
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="https://png.pngtree.com/svg/20170228/beauty_404132.png"
            alt="Generic placeholder image" width="140" height="140">
          <h2>ช่างผ่านการอบรมทุกคน</h2>
          <p>ผู้ที่เข้ารับบริการทุกประเภทไม่ว่าจะเป็น สักคิ้ว สักปาก ต่อขนตา หรือ ลิฟติ้งขนตา และบริการอื่นๆ จะได้รับบริการโดยตรงจากช่างผู้ชำนาญงาน เช่น ช่างลิฟติ้งขนตาของเรา ผ่านการอบรมกับ Eleebana ประเทศไทยโดยตรงทุกคน เป็นต้น นอกจากผ่านการอบรมแล้ว ช่างแต่ละคนยังต้องผ่านการฝึกฝนจนชำนาญ ก่อนที่จะให้บริการกับลูกค้าอีก </p>
          
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="rounded-circle" src="https://cdn1.iconfinder.com/data/icons/amenities-outline-ii/48/_beauty-salon-512.png"
            alt="Generic placeholder image" width="140" height="140">
            <h2>อุปกรณ์มาตรฐานสากล</h2>
            <p>ประสบการณ์เป็นพยาบาลที่ประเทศแคนาดา ถึง 11 ปี ด้วยกัน ดังนั้น อาจารย์จึงสามารถนำความรู้ ด้านการพยาบาลมาประยุกต์ใช้กับธุรกิจความงามได้อย่างลงตัว โดยจะเน้นการใช้เครื่องไม้เครื่องมือที่ได้มาตารฐานสากล และให้ความสำคัญมากที่สุดกับเรื่องความสะอาด ปลอดภัย</p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      

    </div><!-- /.container -->


   
  <footer class="footer">
    <?php $this->load->view('include/footer.php');?>
  </footer>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <?php $this->load->view('include/js'); ?>


  <script type="text/javascript">
    $('.carousel').carousel()
    // $("#carouselExampleIndicators").carousel()
  </script>

</body>

</html>