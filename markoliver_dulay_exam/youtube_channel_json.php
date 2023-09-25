<?php 
   require_once 'connection.php';
   
   ?>
<?php
// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

   //channel ID
   $channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw'; 
   try {
       // Query to fetch channel information and the list of videos
       $sql = "SELECT DISTINCT c.title AS channel_title, c.description AS channel_description, c.profile_picture AS channel_profile_picture,
               v.video_link, v.title AS video_title, v.description AS video_description, v.thumbnail AS video_thumbnail
               FROM youtube_channels c
               JOIN youtube_channel_videos v ON c.channel_id = v.channel_id
               WHERE c.channel_id = ?";
       
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s", $channelId);
       $stmt->execute();
       $result = $stmt->get_result();
   
       $channelData = array();
   
       while ($row = $result->fetch_assoc()) {
           $channelData["channel_title"] = $row["channel_title"];
           $channelData["channel_description"] = $row["channel_description"];
           $channelData["channel_profile_picture"] = $row["channel_profile_picture"];
           $channelData["videos"][] = array(
               "video_link" => $row["video_link"],
               "video_title" => $row["video_title"],
               "video_description" => $row["video_description"],
               "video_thumbnail" => $row["video_thumbnail"]
           );
       }
   
       // Output channel data as JSON
       header('Content-Type: application/json');
       echo json_encode($channelData, JSON_PRETTY_PRINT);
   } catch (Exception $e) {
       echo "Error: " . $e->getMessage();
   }
   
   // Close the database connection
   $conn->close();
   ?>