<style>
ul {
  list-style: none;
  padding: 0;
  margin: 0;
  background:#99FF00;
  border-radius:10px 10px 10px 10px;
}

ul li {
  display: block;
  position: relative;
  float: left;
  background: #99FF00;
  border-radius:20px 20px 20px 20px;
  
}

/* This hides the dropdowns */


li ul { display: none; }

ul li a {
  display: block;
  padding: 1em;
  text-decoration: none;
  white-space: nowrap;
  color:#0000CC;
 font-size:17px;
 font:bold;
  
  }

ul li a:hover {  }

/* Display the dropdown */


li:hover > ul {
  display: block;
  position: absolute;
}

li:hover li { float: none; }

li:hover a {color: black;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjgyIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMC4xNiIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); /* IE9+ SVG equivalent  of linear gradients */
background: -moz-linear-gradient(top,  rgba(255,255,255,0.82) 0%, rgba(255,255,255,0.16) 100%); /* fade from white (0.82 opacty) to 0.16 opacity */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.82)), color-stop(100%,rgba(255,255,255,0.16)));
background: -webkit-linear-gradient(top,  rgba(255,255,255,0.82) 0%,rgba(255,255,255,0.16) 100%);
background: -o-linear-gradient(top,  rgba(255,255,255,0.82) 0%,rgba(255,255,255,0.16) 100%);
background: -ms-linear-gradient(top,  rgba(255,255,255,0.82) 0%,rgba(255,255,255,0.16) 100%);
background: linear-gradient(top,  rgba(255,255,255,0.82) 0%,rgba(255,255,255,0.16) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d1ffffff', endColorstr='#29ffffff',GradientType=0 );
-moz-box-shadow: 0 0 5px #595959; /* CSS3 box shadows */
-webkit-box-shadow: 0 0 5px #595959;
box-shadow: 0 0 5px #595959;
padding-top: 12px; /* large padding to get menu item to protrude upwards */
padding-bottom: 20px; /* large padding to get menu item to protrude downwards */
 }

li:hover li a:hover { background: #FFFF00; }

.main-navigation li ul li { border-top: 0; }

/* Displays second level dropdowns to the right of the first level dropdown */


ul ul ul {
  left: 100%;
  top: 0;
}

/* Simple clearfix */



ul:before,
ul:after {
  content: " "; /* 1 */
  display: table; /* 2 */
}

ul:after { clear: both; }
</style>

	<ul class="main-navigation">
  <li><a href="dashboard.php">Home</a></li>
  <li><a href="change_password.php">Change Password</a></li>
  <li><a href="#">Add</a>
    <ul>
      <li><a href="add_category.php">Category</a></li>      
      <li><a href="add_subcategory.php">Subcategory</a></li>
      <li><a href="add_city.php">City</a></li>
      <li><a href="add_imp_no.php">Imp No</a></li>
      <li><a href="add_imp_website.php">Imp website</a></li>
      <li><a href="add_news.php">News</a></li>
      <li><a href="add_school_college.php">School/Clg</a></li>
      <li><a href="business_tycon.php">Business Tycon</a></li>
     </ul>
  </li>
 
     <li><a href="#">View</a>
    <ul>
      <li><a href="view_listing.php">Free Listing</a></li>
      <li><a href="view_job.php">Post Job</a></li>
      <li><a href="view_resume.php">Post Resume</a></li>
      <li><a href="view_contact.php">Contact Detail</a></li>
      
    </ul>
  	</li>
  
    <li><a href="logout.php">Logout</a></li>
	</ul>
