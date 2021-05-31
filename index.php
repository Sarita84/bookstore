<?php 
	session_start();
	include "process.php";
	$pagename = "Home";
	
	$perPage = 4;
	$page = 1;

	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}
	else
		$page = 1;

	$offset = ($page-1) * $perPage;

	$data = getBooks($offset, $perPage);
	include "header.php";
?>

<section id="content" class="py-3">
	
	<h2 class="text-center mb-5">View Our Collection</h2>

	<div id="books">
		<div class="container">
			<div class="row">
				<?php 
			foreach($data as $book){
			?>
				<div class="book col-sm-3">
					<div class="book-cover">
						<a href="singleBook.php?book=<?php echo $book["book_id"]?>"><img class="booksize" src="<?php echo $book['book_cover']?>" alt=""></a>
					</div>
					<div class="book-content">
						<h5><a href="singleBook.php?book=<?php echo $book["book_id"]?>"><?php echo $book["book_name"]?></a></h5>
						<p>
							<?php 
								if(!empty($book["book_salerpice"])){
									echo "<span class='fas fa-rupee-sign'></span> ";
									echo "<del>".$book['book_saleprice']."</del>";
									echo "<span>".$book['book_regp']."</span>";
								}
								else{
									echo "<span class='fas fa-rupee-sign'></span> ";
									echo "<span>".$book['book_regp']."</span>";
								}
							?>
								
						</p>
					</div>
				</div>
			<?php }?>
			</div>
		</div>
		
	</div>

	<div class="py-3">
		<div class="container">
			<div class="row">
				<?php echo pagination($perPage); ?>
			</div>
		</div>
	</div>

	<div id="recentlyViewed">
		<h3 class="text-center">You recently viewed</h3>
		<div class="container">
			<div class="row">
				<?php 
				    if(isset($_COOKIE["books"])){
				    	$b = $_COOKIE["books"];
				   		 //$query = "select book_cover from bookdetail where book_id='".$b."'";
				    	 // echo $b; exit;

				    	//$books = explode(",",$b);
				    	$data=getbookcover($b);
				    	
				    	foreach($data as $book){
							//echo "<a href='singleBook.php'><img class='cookie' src='".$book['book_cover']."'></a>" ;
							echo "<img class='cookie' src='".$book['book_cover']."'>";
				    	}
				    }
				    else{
				    	echo "<p class='text-center'>Nothing to show here</p>";
				    }
				 ?>
				<div class="d-inline-block"></div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php";?>