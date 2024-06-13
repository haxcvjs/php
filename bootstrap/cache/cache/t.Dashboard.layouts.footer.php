<?php return function($data) { 

            foreach ($data as $key => $value) {
                $$key = $value;
            }
            ?> 
            
<footer>
    <ul>
        <li>About Us</li>
        <li>Contact Us</li>
    </ul>
    <div>copy rights recieved</div>
</footer>
</body>
</html>
            
             <?php } ?>
            