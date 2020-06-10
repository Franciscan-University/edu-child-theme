<?php
	if(isset($_POST['btn_save']) and $_POST['btn_save'] == 'Save' )
	{
		update_option("navbarsettings", $_POST['footerbar']);		
		?>
		<div class="updated">
	<p class="wpjm-updater-dismiss" style="float:right;"><a href="">Hide notice</a></p>
	<p>Settings Updated Successfully.</p>
</div>
		<?php
	}
	
	$navbarsettings = get_option("navbarsettings");
	//echo "<pre>"; print_r($navbarsettings);echo "</pre>"; 
?> 
  <style>.wp-admin select{width:180px;}
  input[type=text]{ padding:0 10px !important; }
  
  </style>
  <div id="wrap">
	<h1>Footer Navbar Settings</h1>
	<form name="frm" action="" method="post">
	<table class="wp-list-table widefat " width="100%"> 
    <thead>
    <tr><td colspan="2" scope="col" class="manage-column column-username show_user_name">
    </tr>
          <tr>
            <td colspan="2" scope="col" class="manage-column column-username show_user_name" >
				<label style="float:left" for="category_name">Menu 1
               	<input type="text" value="<?php echo $navbarsettings['menuTitle1'] ?>" placeholder="Menu Title" name="footerbar[menuTitle1]" />
				
				<input type="text" value="<?php echo $navbarsettings['menulink1'] ?>" placeholder="Menu Link" name="footerbar[menulink1]" />	
                
                <input type="text" value="<?php echo $navbarsettings['menuicon1'] ?>" placeholder="Menu Icon" name="footerbar[menuicon1]" />	
				
							</label>               	  
            </td>
          </tr>
		  <tr>
            <td colspan="2" scope="col" class="manage-column column-username show_user_name" >
				<label style="float:left" for="category_name">Menu 2
               	<input type="text" value="<?php echo $navbarsettings['menuTitle2'] ?>" placeholder="Menu Title" name="footerbar[menuTitle2]" />	
				
				<input type="text" value="<?php echo $navbarsettings['menulink2'] ?>" placeholder="Menu Link" name="footerbar[menulink2]" />	
                
                <input type="text" value="<?php echo $navbarsettings['menuicon2'] ?>" placeholder="Menu Icon" name="footerbar[menuicon2]" />	
				
							</label>               	  
            </td>
          </tr>
		  <tr>
            <td colspan="2" scope="col" class="manage-column column-username show_user_name" >
				<label style="float:left" for="category_name">Menu 3
               	<input type="text" value="<?php echo $navbarsettings['menuTitle3'] ?>" placeholder="Menu Title" name="footerbar[menuTitle3]" />	
				
				<input type="text" value="<?php echo $navbarsettings['menulink3'] ?>" placeholder="Menu Link" name="footerbar[menulink3]" />	
                
                <input type="text" value="<?php echo $navbarsettings['menuicon3'] ?>" placeholder="Menu Icon" name="footerbar[menuicon3]" />	
				
							</label>               	  
            </td>
          </tr>
		  <tr>
            <td colspan="2" scope="col" class="manage-column column-username show_user_name" >
				<label style="float:left" for="category_name">Menu 4
               	<input type="text" value="<?php echo $navbarsettings['menuTitle4'] ?>" placeholder="Menu Title" name="footerbar[menuTitle4]" />	
				
				<input type="text" value="<?php echo $navbarsettings['menulink4'] ?>" placeholder="Menu Link" name="footerbar[menulink4]" />	
                
                <input type="text" value="<?php echo $navbarsettings['menuicon4'] ?>" placeholder="Menu Icon" name="footerbar[menuicon4]" />	
				
							</label>               	  
            </td>
          </tr>
		  <tr>
            <td colspan="2" scope="col" class="manage-column column-username show_user_name" >
				<label style="float:left" for="category_name">Menu 5
               	<input type="text" value="<?php echo $navbarsettings['menuTitle5'] ?>" placeholder="Menu Title" name="footerbar[menuTitle5]" />	
				
				<input type="text" value="<?php echo $navbarsettings['menulink5'] ?>" placeholder="Menu Link" name="footerbar[menulink5]" />	
                
                <input type="text" value="<?php echo $navbarsettings['menuicon5'] ?>" placeholder="Menu Icon" name="footerbar[menuicon5]" />	
				
							</label>               	  
            </td>
          </tr>
		  <tr><td><input type="submit" name="btn_save" value="Save" class="button button-primary" /></td></tr>
          <tr>
            <td colspan="2" scope="col" class="manage-column column-username " ><br /></td>
          </tr>
        </thead>        
      </table>
    </form>