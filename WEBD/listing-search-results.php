<?php
/*
Hector Mariscal
2018-12-09
WEBD3201 - Listing Search Results
*/

require "./header.php";
global $conn;

  $output = "";
  if(!isset($_SESSION['listing_results']))
    {
        $_SESSION['message'] = "An Issue with the search has occurred";
        redirect('./listing_search.php');
    }else{
        $results = $_SESSION['listing_results'];
    }
	$total_pages = ceil((count($results))/LISTINGS_PER_PAGE);
	$current_page = ((isset($_GET['page']) && trim($_GET['page']) != "" && is_numeric(trim($_GET['page'])) && $_GET['page']) > 0)? ceil($_GET['page']) : 1;		
	
	if ($current_page > $total_pages) {
    $current_page = $total_pages;
	}
	
	echo "Page " . $current_page . " out of " . $total_pages;
?>

<h3>Listing Search Results</h3>

<?php
	
	if ($total_pages > 1) {
    $nav = paginate("listing-search-results.php", $current_page, $total_pages);
    echo "<br/><br/><br/><br/>".$nav."<br/>";
    $output = "";

    for ($i = ($current_page - 1) * LISTINGS_PER_PAGE; $i < ($current_page * LISTINGS_PER_PAGE) && $i < sizeof($results); $i++) { 
        $listing_id = $results[$i]['listing_id'];
		$result = pg_execute($conn, "listing_info", array($listing_id));
		$listing = pg_fetch_assoc($result, 0);
		$price = $listing['price'];
		$bedrooms = get_property("bedrooms", $listing['bedrooms'] );
		$bathrooms = get_property("bathrooms", $listing['bathrooms'] );
		echo build_preview($listing_id, $price, $bedrooms, $bathrooms);
    }
    echo $nav;
	}else if($total_pages == 1){
		 for ($i = ($current_page - 1)*LISTINGS_PER_PAGE; $i < ($current_page * LISTINGS_PER_PAGE) && ($i < count($matches)); $i++) { 
			$listing_id = $matches[$i]['listing_id'];
			$result = pg_execute($conn, "listing_info", array($listing_id));
			$listing = pg_fetch_assoc($result, 0);
			$price = $listing['price'];
			$bedrooms = get_property("bedrooms", $listing['bedrooms'] );
			$bathrooms = get_property("bathrooms", $listing['bathrooms'] );
			echo display_preview($listing_id, $price, $bedrooms, $bathrooms);
			}
	}


 include("./footer.php");
?>