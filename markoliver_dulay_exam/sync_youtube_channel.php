<?php
require_once 'connection.php';

if (isset($_POST['save'])) {
    session_start();
    require_once 'vendor/autoload.php';

    // YouTube API key
    $apiKey = 'AIzaSyAhXskMxFEGs95yoIsZiZTHzxgueZ-4AUg'; 
    // channel ID 
    $channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw';
    
    
    /*
    //channel url testing
    https://www.googleapis.com/youtube/v3/channels?key=AIzaSyAhXskMxFEGs95yoIsZiZTHzxgueZ-4AUg&id=UC_x5XG1OV2P6uZZ5FSM9Ttw&part=snippet
    */

    try {
        // Fetch channel information
        $channelUrl = "https://www.googleapis.com/youtube/v3/channels?key={$apiKey}&id={$channelId}&part=snippet";
        $channelData = json_decode(file_get_contents($channelUrl));

        if (isset($channelData->items[0])) {
            $channelTitle = $channelData->items[0]->snippet->title;
            $channelDescription = $channelData->items[0]->snippet->description;
            $channelProfilePicture = $channelData->items[0]->snippet->thumbnails->default->url; // Change to desired thumbnail size

            // Insert channel information into the database using prepared statement
            $sql = "INSERT INTO youtube_channels (channel_id, title, description, profile_picture) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $channelId, $channelTitle, $channelDescription, $channelProfilePicture);
            $stmt->execute();

            // Fetch the 100 most recent videos from the channel
            $count = 0; // Initialize a count variable
            $pageToken = null;

            while ($count < 1) {
                $videoUrl = "https://www.googleapis.com/youtube/v3/search?key={$apiKey}&channelId={$channelId}&order=date&type=video&part=snippet&maxResults=50&pageToken={$pageToken}";
                $videoData = json_decode(file_get_contents($videoUrl));

                foreach ($videoData->items as $video) {
                    if ($count >= 1) {
                        break 2; // Stop saving after 100 records
                    }

                    $videoTitle = $video->snippet->title;
                    $videoDescription = $video->snippet->description;
                    $videoId = $video->id->videoId;
                    $videoLink = "https://www.youtube.com/watch?v=" . $videoId;
                    $videoThumbnail = $video->snippet->thumbnails->default->url; // Change to desired thumbnail size

                    // Check if the video link already exists in the youtube_channel_videos table
                    $checkSql = "SELECT * FROM youtube_channel_videos WHERE video_link = ?";
                    $stmt_check = $conn->prepare($checkSql);
                    $stmt_check->bind_param("s", $videoLink);
                    $stmt_check->execute();
                    $result = $stmt_check->get_result();

                    if ($result->num_rows == 0) {
                        // Insert video information into the youtube_channel_videos table
                        $insertSql = "INSERT INTO youtube_channel_videos (channel_id, video_link, title, description, thumbnail)
                                VALUES (?, ?, ?, ?, ?)";
                        $stmt_insert = $conn->prepare($insertSql);
                        $stmt_insert->bind_param("sssss", $channelId, $videoLink, $videoTitle, $videoDescription, $videoThumbnail);
                        $stmt_insert->execute();

                        $count++; // Increment the count after saving a record
                    }
                }

                // Check if there are more pages of results
                if (isset($videoData->nextPageToken)) {
                    $pageToken = $videoData->nextPageToken;
                } else {
                    break; // No more pages to fetch
                }
            }

            // Set session variables for success
            $_SESSION['statustitle'] = 'Success';
            $_SESSION['statustext'] = 'Your data was saved!';
            $_SESSION['icon'] = 'success';

            header("Location: index.php"); // Redirect to the dashboard page
        } else {
            // Set session variables for error
            $_SESSION['statustitle'] = 'Error: Channel not found.';
            $_SESSION['statustext'] = ''; // You can customize this message if needed
            $_SESSION['icon'] = 'error';

            header("Location: index.php"); // Redirect to the dashboard page
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn->close();
}
?>
