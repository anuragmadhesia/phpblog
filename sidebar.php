<style>
    @media screen and (max-width:768px) {
        .sidebar-to-hide {
            display: none;
        }
}
</style>
<script>
    function curr_dt(params) {
        var curdate=document.getElementById('cur_date');
        var day=document.getElementById('cur_day');
        var time=document.getElementById('cur_time');
        let date = new Date();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        let day_night = "AM";
        if(hours > 12){
          day_night = "PM";
          hours = hours - 12;
        }
        if(seconds < 10){
          seconds = "0" + seconds;
        }
        if(minutes < 10){
          minutes = "0" + minutes;
        }
        if(hours < 10){
          hours = "0" + hours;
        }
        var cday='';
        switch (date.getDay()) {
            case 0:
                cday='Sunday';
                break;
            case 1:
                cday='Monday';
                break;
            case 2:
                cday='Tuesday';
                break;
            case 3:
                cday='Wednesday';
                break;
            case 4:
                cday='Thrusday';
                break;
            case 5:
                cday='Friday';
                break;
            case 6:
                cday='Saturday';
                break;
            default:
                cday='';
                break;
        }
        time.textContent = `${hours} : ${minutes} : ${seconds} ${day_night}`;
        curdate.textContent = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`;
        day.textContent = `${cday}`;
    }
    setInterval(curr_dt,1000);
</script>
<div class="col-sm-3 my-3 sidebar-to-hide">
    <div class="bg-light mx-3 p-3 rounded text-center">
        <h5 id="cur_date" class="bg-warning p-2"></h5>
        <h4 id="cur_day" class="text-info"></h4>
        <h6 id="cur_time" class="bg-success p-2"></h6>
    </div>
    <div class="bg-light m-3 p-3 rounded">
        <h4>Recent Article</h4><hr style="border: 1px solid black;"/>
        <?php
            $sidebar = $db->query('SELECT articleTitle, articleSlug FROM blog ORDER BY articleId DESC LIMIT 6');
            while($row = $sidebar->fetch()){
                echo ' <a href="http://localhost:8080/blog/'.$row['articleSlug'].'">'.$row['articleTitle'].' </a ><hr style="border-top: 1px dashed grey;"/>';
            }
        ?>
    </div>
    <div class="bg-light m-3 p-3 rounded">
        <h4 >Categories</h4><hr style="border: 1px solid black;"/>
        <?php
        $stmt = $db->query('SELECT categoryName, categorySlug FROM category ORDER BY categoryId DESC');
        while($row = $stmt->fetch()){
            echo '<a href="http://localhost:8080/blog/category/'.$row['categorySlug'].'">'.$row['categoryName'].'</a><hr style="border-top: 1px dashed grey;"/>';
        }
        ?>
    </div>
    <div class="border boder-dark bg-light m-3 p-3 rounded">
        <h4>Tags</h4><hr style="border: 1px solid black;"/>
        <?php
            $tagsArray = [];
            $stmt = $db->query('select distinct LOWER(articleTags) as articleTags from blog where articleTags != "" group by articleTags');
            while($row = $stmt->fetch()){
                $parts = explode(',', $row['articleTags']);
                foreach ($parts as $tag) {
                    $tagsArray[] = $tag;
                }
            }

            $finalTags = array_unique($tagsArray);
            foreach ($finalTags as $tag) {
                echo "<a href='http://localhost:8080/blog/tag/".$tag."' class='btn btn-secondary btn-sm m-1 p-1'>".ucwords($tag)."</a>";
            }
        ?>
    </div>
</div>