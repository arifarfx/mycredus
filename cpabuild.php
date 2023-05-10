<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Offerwall</title>
    <style>
        .offer-container {
            display: flex;
            align-items: center;
            text-decoration: none;
			border: 1px double grey;
			margin-bottom:10px;
			padding-top:5px;
			padding-bottom:5px;
			padding-left:10px;
        }

        .offer-container:hover {
            background-color: #f0f0f0;
	        border: 1px double yellow;
        }

        .network-icon {
            height: 60px;
            margin-right: 10px;
        }

        .offer-details {
            line-height: 1.2;
        }
    </style>
	
</head>
<body>
    <?php
        $api_url = 'https://d2tk42wfs4q183.cloudfront.net/public/offers/feed.php?user_id=3986&api_key=dc37baf12f1ecf11766fc90bc1ae9745&s1=&s2=';
        $json_data = file_get_contents($api_url);
        $offers = json_decode($json_data, true);

        $counter = 0;
        foreach ($offers as $offer_data) {
            if ($counter >= 10) {
                break;
            }
    ?>
	
    <a href="<?php echo $offer_data['url']; ?>" class="offer-container">
        <img src="<?php echo $offer_data['network_icon']; ?>" alt="<?php echo $offer_data['name']; ?>" class="network-icon">
        <div class="offer-details">
			<div><b><?php echo $offer_data['name']; ?></b></div>
            <div>Complete and Get <?php echo $offer_data['payout']* 1000; ?> Points</div>
            <div><?php echo $offer_data['anchor']; ?></div>
        </div>
    </a>

    <?php
            $counter++;
        }
    ?>
</body>
</html>
