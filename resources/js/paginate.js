export default {
    data() {
        return {
            page: 1,
            perPage: 5,
            pages: [],
            paginateList:[],
        }
    },
    filters: {
        cutText(value, symbolsCount) {
            return value.length > symbolsCount
                ? value.slice(0, symbolsCount - 3) + '...'
                : value;
        }
    },
    methods: {
        setPages () {
            let numberOfPages = Math.ceil(this.paginateList.length / this.perPage);
            this.pages=[];
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        deleteRecord(array,id)
        {
            let index =array.findIndex(el => el.id === id)
            array.splice(index,1)
        },
        paginate (posts) {
            let page = this.page;
            let perPage = this.perPage;
            let from = (page * perPage) - perPage;
            let to = (page * perPage);
            return  posts.slice(from, to);
        },
        openSlide(){
            window.scrollTo(0, 0)
        }
    },
    computed: {
        displayedPosts () {

            return this.paginate(this.paginateList)
        }
    },
    watch:{
        page(){
            this.openSlide();
        }
    }
}
