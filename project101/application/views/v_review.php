
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

    <main role="main" class="container">
    
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">With textarea</span>
            </div>
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>

        <br/>
        <br/>

        
        <div class="container">
        <br/>
        <br/>
          <div class="row">
          
            <?php foreach($m_review->result() as $ser ){ ?>
                
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                     <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">
                         <a class="text-dark" href="#">Featured post</a>
                         </h3>
                            <div class="mb-1 text-muted">Nov 12</div>
                                <p class="card-text mb-auto"> <?php echo $ser->review_message ?></p>
                                <a href="#">Continue reading</a>
                             </div>
                         <img class="card-img-right flex-auto d-none d-md-block" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="https://s.isanook.com/wo/0/rp/r/w700/ya0xa0m1w0/aHR0cHM6Ly9zLmlzYW5vb2suY29tL3dvLzAvdWQvMjIvMTEzNzQxL2hpMS5qcGc=.jpg" data-holder-rendered="true">
                     </div>
                </div>
        
                
            <?php } ?>
            
            
          </div>
        </div> 
        

    

    </main>

    <!-- FOOTER -->
    <footer class="footer">
    <?php $this->load->view('include/footer.php');?>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php $this->load->view('include/js'); ?>
  </body>
</html>
