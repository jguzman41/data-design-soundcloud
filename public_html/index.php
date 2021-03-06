<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<!-- add CSS file -->
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css"  />
		<title> Data Design Assignment</title>
	</head>
	<body>
		<!-- this is the header-->
		<header>
			<h1>Soundcloud.
				Yep, anything can be music now.</h1>
			<img src="img/soundcloud-logo.png" alt="soundcloud-logo.png" width="50%">
		</header>
		<!-- this is the main page content-->
		<main>
			<!-- begin section 1-->
			<section>
				<h1>Persona</h1>
				<img src="img/yungdust.jpg" alt="YungDust">
				<p>This is Daniel. He owns a fairly recent Mac. He makes music. He's a Computer Science student at UNM who is interested in sound design and music production.He wants to upload his music to soundcloud so that his friends and potential fans can listen to it. He wants to make his music easily to locate amongst billions of hours of sound uploaded to Soundcloud. Luckily, a feature exists that allows him to do just that... Tagging! Tagging will help listeners who have found other similar artists find him. It will also help those who listen to his music link out into other similar songs.</p>

				<h3>Some of his favorite tags include</h3>
				<ul>
					<li>#HipHop</li>
					<li>#Rap</li>
					<li>#HipHop-Rap</li>
				</ul>
			</section>

			<!-- begin section 2-->

			<section>
				<h1>Use Case</h1>
				<p> After promising a new mixtape release at midnight to all of his die hard fan and twitter followers, Daniel logs in at 11:57 and prepares the upload. While the files upload, he fills out the rest of the fields in the upload process. this includes his tags. Once everything is done uploading, he is able to attach tags tothe abum as a whole, as well as attach tags to each individual song. Finally, he selects "submit" and the new music is realeased upon the world!</p>
			</section>


			<!-- begin section 3-->
			<section>
				<h1>Entities</h1>
				<h3>The entities involved include:</h3>
					<ul>
						<li>tag (WEAK)</li>
							<ul>
								<li>tagLabel</li>
									<ul>
										<li>n-1 relationship to song</li>
									</ul>
							</ul>
						<li>song (STRONG)</li>
							<ul>
								<li>songWave</li>
								<li>songReaction</li>
								<li>songProfileId</li>
									<ul>
										<li>foreign key to song</li>
										<li>m-n relationship between song and profiles</li>
									</ul>
								<li>songImage</li>
								<li>songId</li>
									<ul>
										<li>primary key for song</li>
										<li>n-1 relationship with user</li>
									</ul>
								<li>songDateTime</li>
							</ul>
						<li>profile (STRONG)</li>
								<ul>
									<li>profilePicture</li>
									<li>profileFollowers</li>
									<li>profileId</li>
								</ul>
										<ul>
											<li>n-1 profiles to song</li>
										</ul>
					</ul>

				<!-- begin section 4 -->
				<h1>Interaction Flow</h1>
					<ul>
						<li>user signs in</li>
						<li>user selects "upload"</li>
						<li>user selects song to upload</li>
						<li>user fills out required information</li>
						<li>user adds tags</li>
						<li>user selects "upload"</li>
						<li>song upload and tagging process complete</li>
					</ul>

				<img src="img/final-soundcloud-erd.png" alt="ERD-Diagram" width="50%">

				<!-- Soundcloud Player embed-->
				<iframe width="50%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/38377533&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
			</section>

		</main>
	</body>
</html>