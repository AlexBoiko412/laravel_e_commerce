export const Api = {
    headers() {
        return {
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('at')}`
        };
    },
    async post(url, data = {}) {
        return $.ajax({
            url: `/api${url}`,
            method: 'POST',
            headers: this.headers(),
            data: data
        });
    },
    async get(url) {
        return $.ajax({
            url: `/api${url}`,
            method: 'GET',
            headers: this.headers()
        });
    }
};
