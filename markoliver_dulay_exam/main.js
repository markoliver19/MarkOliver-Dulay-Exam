const app = Vue.createApp({
    data() {
        return {
            videos: [],
            currentPage: 1,
            itemsPerPage: 20,
        };
    },
    computed: {
        paginatedVideos() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = Math.min(startIndex + this.itemsPerPage, this.videos.length);
            return this.videos.slice(startIndex, endIndex);
        },
        totalPages() {
            return Math.ceil(this.videos.length / this.itemsPerPage);
        },
        pageNumbers() {
            const maxVisiblePages = 5;
            const startPage = Math.max(1, this.currentPage - Math.floor(maxVisiblePages / 2));
            const endPage = Math.min(startPage + maxVisiblePages - 1, this.totalPages);
            return Array.from({ length: endPage - startPage + 1 }, (_, i) => startPage + i);
        },
    },
    methods: {
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToPage(pageNumber) {
            this.currentPage = pageNumber;
        },
        truncateText(text, maxLength) {
            return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
        },
        async fetchData() {
            try {
                const response = await axios.get('http://localhost:8001/dulay_exam/youtube_channel_json.php');
                this.videos = response.data.videos;
            } catch (error) {
                console.error(error);
            }
        },
    },
    mounted() {
        this.fetchData();
    },
});

app.mount('#app');
