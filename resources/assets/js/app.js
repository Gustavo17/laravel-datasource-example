
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

import Datasource from 'vue-datasource';

const app = new Vue({
    el: '#app',
    components: {
        Datasource
    },
    data() {
        return {
            users: {
                pagination: {},
                data: []
            },
            columns: [
                {
                    name: 'Id',
                    key: 'id',
                    render(value) {
                        return `# ${value}`;
                    }
                },
                {
                    name: 'Name',
                    key: 'name'
                },
                {
                    name: 'Email',
                    key: 'email'
                },
                {
                    name: 'City',
                    key: 'city'
                },
                {
                    name: 'Company',
                    key: 'company'
                },
                {
                    name: 'Job',
                    key: 'job'
                },
                {
                    name: 'Date',
                    key: 'created_at'
                }
            ],
            actions: [
                {
                    text: 'Edit',
                    icon: 'glyphicon glyphicon-pencil',
                    class: 'btn-primary',
                    event(e, row) {
                        console.warn('Are you clicked me?', e);
                        if(row == null) {
                            console.info('Ups.. data not found :(')
                        } else {
                            console.info('Yeeei, I found this :)', JSON.stringify(row));
                        }
                    }
                },
                {
                    text: 'Delete',
                    icon: 'glyphicon glyphicon-trash',
                    class: 'btn-danger',
                    event(e, row) {
                        console.warn('Are you clicked me?', e);
                        if(row == null) {
                            console.info('Ups.. data not found :(')
                        } else {
                            console.info('Yeeei, I found this :)', JSON.stringify(row));
                        }
                    }
                },
                {
                    text: 'Show',
                    icon: 'glyphicon glyphicon-eye-open',
                    class: 'btn-info',
                    event(e, row) {
                        console.warn('Are you clicked me?', e);
                        if(row == null) {
                            console.info('Ups.. data not found :(')
                        } else {
                            console.info('Yeeei, I found this :)', JSON.stringify(row));
                        }
                    }
                }
            ]
        }
    },
    mounted() {
        this.$http.get('/getusers').then((response) => {
            this.users = response.data;
        });
    },
    methods: {
        changePage(values) {
            this.$http.get(`/getusers?page=${values.page}&per_page=${values.perpage}`).then((response) => {
                this.users = response.data;
            });
        },
        onSearch(searchQuery) {
            console.log('Searching', searchQuery);
            this.$http.get(`/getusers?search=${searchQuery}`).then((response) => {
                this.users = response.data;
            });
        }
    }
});
