<?php snippet('head') ?>

<script type="text/javascript">
	$(window).on('load resize', function() {
		if ($(window).width() < 480) {
			window.location = "/desktop"
		}
	});

</script>

<body>



	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" href="/assets/css/player.css">

	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function() {

			$("#jquery_jplayer_1").jPlayer({
				ready: function() {
					$(this).jPlayer("setMedia", {
						title: "Forever 90\'s",
						m4v: "/assets/media/forever90s.m4v",
						ogv: "/assets/media/forever90s.ogv",
						webmv: "/assets/media/forever90s.webm",
						poster: "/assets/media/forever90s.jpg"
					}).jPlayer("play"); // Attempts to Auto-Play the media
				},

				supplied: "m4v, webmv, ogv",
				size: {
					width: "640px",
					height: "360px",
					cssClass: "jp-video"
				},


				ended: function() {
					window.open("/desktop", "_self");
				},
				useStateClassSkin: true,
				autoBlur: false,
				smoothPlayBar: true,
				keyEnabled: true,
				remainingDuration: false,
				toggleDuration: true
			});

		});
		//]]>

	</script>



	<div class="container">
		<div class="row">

			<div class="col-sm-8 col-sm-offset-2 text-center">
				<div id="jp_container_1" class="jp-video" role="application" aria-label="media player">
					<div class="jp-type-single">
						<div id="jquery_jplayer_1" class="jp-jplayer"></div>
						<div class="jp-gui">
							<div class="jp-video-play">
								<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
							</div>
							<div class="jp-interface">



								<h3>Starting Up ...</h3>

								<div class="voffset1">
									<div class="jp-progress">
										<div class="jp-seek-bar">
											<div class="jp-play-bar"></div>
										</div>
									</div>
								</div>


							</div>

						</div>


						<div class="jp-no-solution">
							<span>Update Required</span> To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
						</div>
					</div>
				</div>


			</div>
			<div class="load-boxes">
				<a href="/desktop"><img src="/assets/media/alt.png" width=48 border=0 class="hoffset1"></a>
				<a href="/desktop"><img src="/assets/media/base.png" width=48 border=0 class="hoffset1"></a>
				<a href="/desktop"><img src="/assets/media/classic.png" width=48 border=0 class="hoffset1"></a>
				<a href="/desktop"><img src="/assets/media/heart.png" width=48 border=0 class="hoffset1"></a>
				<a href="/desktop"><img src="/assets/media/hits.png" width=48 border=0 class="hoffset1"></a>
				<a href="/desktop"><img src="/assets/media/rock.png" width=48 border=0></a>
			</div>
		</div>
	</div>
</body>
