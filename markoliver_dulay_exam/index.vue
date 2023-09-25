<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
     <link rel="stylesheet" href="vuestyle.css">
</head>

<body>
    <div id="app">
        <div class="container">
            <h3 class="text-center"> YouTube Channel Data</h3>
        </div>

        <div class="table-responsive">
            <table id="tableresult" class="table table-striped table-bordered dt-responsive-sm" width="100%">
                <thead>
                    <tr>
                        <th>Video Title</th>
                        <th>Thumbnail</th>
                        <th>Video Link</th>
                        <th class="d-none d-md-table-cell">Video Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(video, index) in paginatedVideos" :key="index">
                        <td>
                            <span class="truncated-text">{{ truncateText(video.video_title, 20) }}</span>
                        </td>
                        <td><img class="picture circular-image" :src="video.video_thumbnail" /></td>
                        <td>
                            <a :href="video.video_link" target="_blank">{{ video.video_link }}</a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="truncated-text">{{ truncateText(video.video_description, 20) }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="custom-pagination">
            <div class="text-center">
                <p v-if="videos.length > 0">
                    Showing {{ (currentPage - 1) * itemsPerPage + 1 }} to
                    {{ Math.min(currentPage * itemsPerPage, videos.length) }} of {{ videos.length }} records
                </p>
            </div>
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" @click="prevPage" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
                <li class="page-item" v-for="pageNumber in pageNumbers" :key="pageNumber"
                    :class="{ active: currentPage === pageNumber }">
                    <a class="page-link" @click="goToPage(pageNumber)">{{ pageNumber }}</a>
                </li>
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link" @click="nextPage" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.0.11/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="main.js"></script> <!-- Include the external JavaScript file -->
</body>

</html>
