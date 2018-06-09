					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-bottom: 11px;">
						  <ul id="menu" class="nav navbar-nav">
							<li data-menuanchor="firstPage"><a href="../main.php" class="hvr-shrink">หน้าหลัก</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle hvr-shrink" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $fname . " " . $lname; ?>
								   <?php echo "(" . $role_name . ")"; ?>
								   <span class="caret"></span>
							   </a>
							   <ul class="dropdown-menu">
								  <li style="padding-top: 14px;"><a href="logout.php">ออกจากระบบ</a></li>
							   </ul>
							</li>
						  </ul>
					</div><!-- /.navbar-collapse -->

				</div>
			</div>
		</div>
	</div> <!--END container-fluid-->

			<div class="container">
			   <div class="error-content has-shadow">
				   <div align="center" style="padding-top: 50px;">
					   <img src="../images/warning.png" width="100px" height="100px"><br><br>
					   <p>
						  <h2 style="font-size: 25px;">ACCESS DENIED</h2>
					  </p><br>
					   <p>
						  <h1 style="font-size: 18px;">You do not have permissions to open this file in the browser.
						  Please contact your system administrator for more information.
						  Thank you.</h1>
					   </p>
				   </div>
			   </div>
			</div> <!-- /container -->
