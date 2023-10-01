'use strict'

class FetchData {

    #originUrl;
    static queryParams;

    constructor(url, params) {
        this.#originUrl = url;
        this.#addQueryParams(params);

        const loadingEl = document.querySelector('.loading');
        loadingEl.classList.remove('d-none');
    }

    #addQueryParams(params) {
        FetchData.queryParams = params ? { ...FetchData.queryParams, ...params } : {};

        if ('page' in FetchData.queryParams && !('page' in params)) {
            delete FetchData.queryParams['page'];
        }
    }

    get #fullUrl() {
        const params = [];

        for (let param in FetchData.queryParams) {
            param = `${param}=${FetchData.queryParams[param]}`;
            params.push(param);
        }

        return `${this.#originUrl}?${params.join('&')}`;
    }

    async getData() {
        const fullUrl = this.#fullUrl;
        const response = await fetch(fullUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).catch(error => {
                throw new Error('An error occurred while receiving data', error);
            });

        return response;
    }

}

class ShowData {

    #data;
    #path;
    #currentPage;
    #lastPage;
    #keys = [];

    constructor(results) {
        this.#data = results.data;
        this.#path = results.path;
        this.#currentPage = results.current_page;
        this.#lastPage = results.last_page;
        const loadingEl = document.querySelector('.loading');
        loadingEl.classList.add('d-none');
    }


    set keys(keys) {
        this.#keys = keys;
    }

    show() {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';
        let count = this.#currentPage === 1 ? 1 : 10 * (this.#currentPage - 1) + 1;

        if (this.#data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">هیچ موردی یافت نشد.</td>
                </tr>
            `;
        }

        for (const index in this.#data) {
            const record = this.#data[index];
            const tr = document.createElement('tr');
            const countTd = document.createElement('td');
            countTd.textContent = count;
            tr.appendChild(countTd);
            for (const key of this.#keys) {
                const td = document.createElement('td');
                td.textContent = record[key];
                tr.appendChild(td);
            }

            const operationTd = document.createElement('td');
            operationTd.innerHTML = `<a href="${window.location.href + "/" + record.id}" class="text-decoration-none text-info mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path>
                </svg>
            </a>`;
            tr.appendChild(operationTd);

            count++;
            tbody.appendChild(tr);
        }
        this.#handlePagination();

    }

    #handlePagination() {
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = '';
        const pages = [];
        if (this.#lastPage > 1) {
            if (this.#currentPage > 1) {
                const prevBtn =
                    `<li class="page-item"><button class="page-link" data-path="${this.#path}" data-params='{"page": ${this.#currentPage - 1}}' data-keys="${this.#keys}" > قبلی </button></li>`;
                pages.push(prevBtn);
            }
            for (let i = 1; i <= this.#lastPage; i++) {
                const element =
                    `<li class="page-item ${i == this.#currentPage ? 'active' : ''}"><button class="page-link" data-params='{"page": ${i}}'  >${i}</button></li>`;
                pages.push(element);
            }
            if (this.#currentPage < this.#lastPage) {
                const nextBtn =
                    `<li class="page-item"><button class="page-link" data-params='{"page": ${this.#currentPage + 1}}'> بعدی </button></li>`;
                pages.push(nextBtn);
            }

            pages.forEach(element => {
                pagination.innerHTML += element;
            });
        }

    }


}

async function cookUp(request, dataKeys) {
    const requestData = new FetchData(request.url, request.params);
    const results = await requestData.getData();
    const showData = new ShowData(results);
    showData.keys = dataKeys;
    showData.show();
}
