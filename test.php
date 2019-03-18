<html>
<head>
   <script type="text/javascript" src="ckeditor.js"></script>
    
</head>
<body><form method="post">
    <p><textarea name="description" id="description" rows="4" class="ckeditor"  placeholder="Description Here..."></textarea>
        </p> 
    
    <p><input type="submit" name="submit" class="btn btn-success" value="submit"></p>
    </form>
</body>
</html>

<?php

if (isset($_POST['submit']))
               {
            $mid=$_POST['description'];
    echo $mid;
    
           
}


?>