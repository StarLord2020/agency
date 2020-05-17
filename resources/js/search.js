
export default {
    data() {
        return {
            search:{
                city:null,
                specialty_id:null
            }
        }
    },
    methods: {
        filteredList: function() {

            if(!this.search.specialty_id&&!this.search.city){

                return this.bids;
            }

            return this.bids.filter(bid =>
                (this.search.specialty_id? bid.specialty == this.search.specialty_id:true)
                &&
                (this.search.city? !bid.address.indexOf(this.search.city):true)
            );
        },
    },
    computed: {

    },
    watch:{

    }
}
