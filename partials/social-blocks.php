<section id="social">
	<div class="container">
			<h2>Social</h2>
			<div class="twitter">
				<?php
				require get_stylesheet_directory() . '/inc/twitteroauth/twitteroauth.php';

				// TWITTER OAUTH SETTINGS
				$twitteruser = 'HeatonCooper';
				$notweets = '1';	
				
				$consumerkey = '9DPVpbKZrmEZTQg22Pew3ugdh';
				$consumersecret = '66aidzoIGYjCYgRHGl3CobCytP0rQ9pUKRUn8GMHt5VnTNLxYu';
				$accesstoken = '2831854230-GrxkTpQQYpg3DctdX28ltNvO2yD2hzb2U0t7PAG';
				$accesstokensecret = 's8tX5BqTduoCUyZfumAscuVULqCmODSiNBWqDfQzcNXeC';

				function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		  			$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
					return $connection;
				}

				$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
				$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&include_rts=true&exclude_replies=true&trim_user=true&contributor_details=false&count=".$notweets);
			    $counter = 0; //set up a counter so we can count the number of iterations
				if ($tweets): ?>
				<i class="fa fa-twitter"></i>
				<?php 
				foreach ($tweets as $tweet):
				if (isset($tweet->entities->media[0])):
					$counter++;
					$created = $tweet->created_at;
					$text = $tweet->text;
					$tweet_url = $tweet->entities->media[0]->url;
					$media = $tweet->entities->media[0];
					$media_url = $media->media_url_https;
				?>
				<div class="tweet">
					<div class="tweet-text">
						<a href="<?php echo $tweet_url; ?>" target="_blank" rel="nofollow">

						<p><?php echo $text; ?></p>

						<div class="tw-img" style="background-image: url(<?php echo $media_url; ?>);"></div>

						<small><em>Posted on <?php echo date('l jS F Y G:i', strtotime($created)); ?></em></small>

						</a>
					</div>
				</div>
				<?php endif;
				if ($counter == $notweets) break;
				endforeach;
				?>
				<?php else: ?>
				<div class="no-tweet">
					<h3>Follow us on Twitter. <a href="https://twitter.com/HeatonCooper" target="_blank">@HeatonCooper</a></h3>
				</div>
				<?php endif; ?>
			</div>

			<div class="insta">
				<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50.0% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BFnOKZTkLbw/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">Fells to fjords #exhibition #grasmere #culture #lakedistrict #scandinavia #alfredheatoncooper #art</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:25px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A photo posted by Heaton Cooper Studio (@heatoncooperstudio) on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2016-05-20T02:47:21+00:00">May 19, 2016 at 7:47pm PDT</time></p></div></blockquote> <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>				
			</div>

			<div class="find">
				<?php 

				$location = get_field('location_map', 'options');

				if( !empty($location) ):
				?>
				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
				<?php endif; ?>
				<div class="mailing">
					<h4>Stay in Touch</h4>
					<p>Join our mailing list for occasional news on offers, events, workshops and more.</p>
					<!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup">
						<form action="//pixelpudu.us10.list-manage.com/subscribe/post?u=240b9b99aca0d1323564e1a15&amp;id=2d18715050" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						    <div id="mc_embed_signup_scroll">
							
							<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="enter email address" required>
						    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_240b9b99aca0d1323564e1a15_2d18715050" tabindex="-1" value=""></div>
						    <div class="clear"><input type="submit" value="Sign up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						    </div>
						</form>
						</div>
					<!--End mc_embed_signup-->
				</div>
			</div>
	</div>
</section>
