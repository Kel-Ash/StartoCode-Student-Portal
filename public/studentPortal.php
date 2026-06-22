 <?php
    include_once(__DIR__ . '/formProcessor.php');
    ?>
 <?php
    include('./HeaderFooter/headerIndex.php'); ?>
 <!--
     ------------------------- 
        Main Content
    --------------------------
                            -->
 <div class="main">
     <div class="student-portal">
         <h2>Student Portal Form</h2>
         <div class="form-section ">
             <div id="error" class="error"></div>
             <p class="form-section-header">Personal Information</p>
         </div>

         <!--
             -------------------------
                    Form Section
            -------------------------
                                -->

         <form action="" method="POST" class="student-form" id="student-user-form" enctype="multipart/form-data">
             <div class="grid-container">
                 <div class="form-group picture-width">
                     <label for="upload-image">Upload Image:</label>
                     <input type="file" id="user-image" name="user-image"
                         placeholder="No file chosen" accept=".jpg, .jpeg, .png" value="<?php displayInputValue('user-image'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-image"); ?></span>
                 </div>

                 <div class="form-group">
                     <label for="firstname">First Name</label>
                     <input type="text" id="user-firstname" name="user-firstname"
                         placeholder="Enter First Name" value="<?php displayInputValue('user-firstname'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-firstname"); ?></span>

                 </div>

                 <div class="form-group">
                     <label for="middlename">Middle Name</label>
                     <input type="text" id="user-middlename" name="user-middlename"
                         placeholder="Enter Middle Name" value="<?php displayInputValue('user-middlename'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-middlename"); ?></span>
                 </div>

                 <div class="form-group">
                     <label for="lastname">Last Name</label>
                     <input type="text" id="user-lastname" name="user-lastname"
                         placeholder="Enter Last Name" value="<?php displayInputValue('user-lastname'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-lastname"); ?></span>
                 </div>

                 <div class="form-group">
                     <label for="email"> Email</label>
                     <input type="email" id="user-email" name="user-email"
                         placeholder="Enter Email Address" value="<?php displayInputValue('user-email'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-email"); ?></span>
                 </div>


                 <div class="form-group">
                     <label for="dob"> Date of Birth</label>
                     <input type="date" id="user-date-of-birth" name="user-date-of-birth"
                         value="<?php displayInputValue('user-date-of-birth'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-date-of-birth"); ?></span>
                 </div>


                 <div class="form-group radio-group">
                     <div class="option">
                         <label for="male"> Male</label>
                         <input type="radio" name="gender" id="gender" value="male">
                         <label for="female"> Female</label>
                         <input type="radio" name="gender" id="gender" value="female">
                     </div>
                     <span style="color: red;"><?php displayErrorMessage("gender"); ?></span>
                 </div>


                 <div class="form-group">
                     <label for="contact"> Phone Number</label>
                     <input type="tel" id="user-phone" name="user-phone"
                         placeholder="Enter Phone Number" value="<?php displayInputValue('user-phone'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-phone"); ?></span>
                 </div>


                 <div class="form-group">
                     <label for="address">Address</label>
                     <textarea name="user-address" id="user-address"
                         placeholder="Enter Address"><?php displayInputValue('user-address'); ?></textarea>
                     <span style="color: red;"><?php displayErrorMessage("user-address"); ?></span>
                 </div>


                 <div class="form-group">
                     <label for="origin"> State of Origin</label>
                     <select id="user-state-of-origin" name="user-state-of-origin">
                         <option>Select-State</option>
                     </select>
                     <span style="color: red;"><?php displayErrorMessage("user-state-of-origin"); ?></span>
                 </div>

                 <div class="form-group">
                     <label for="origin"> Local Government</label>
                     <select id="user-local-government" name="user-local-government">
                         <option>Select-Local-Government</option>
                     </select>
                     <span style="color: red;"><?php displayErrorMessage("user-local-government"); ?></span>
                 </div>

             </div>

             <div class="form-section-header">Academics Related Information</div>

             <div class="grid-container">
                 <div class="form-group">
                     <label for="next-of-king">Next of Kin</label>
                     <input type="text" id="user-next-of-kin" name="user-next-of-kin"
                         placeholder="Enter The Name Of NextOfKin" value="<?php displayInputValue('user-next-of-kin'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-next-of-kin"); ?></span>
                 </div>

                 <div class="form-group">
                     <label for="jamb-score">Jamb Score</label>
                     <input type="text" id="user-jamb-score" name="user-jamb-score"
                         placeholder="Enter Jamb Score" value="<?php displayInputValue('user-jamb-score'); ?>">
                     <span style="color: red;"><?php displayErrorMessage("user-jamb-score"); ?></span>
                 </div>
             </div>

             <div class="submit-container">
                 <button type="submit" class="submit-btn" id="submit" name="submit">Submit</button>
             </div>

         </form>

     </div>

 </div>

 <?php

    include('./HeaderFooter/footerPortal.php'); ?>

 </body>

 </html>