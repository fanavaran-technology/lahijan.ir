'use strict'

class FetchData {

    #originUrl;
    static queryParams;

    constructor(url, params) {
        this.#originUrl = url;
        this.#addQueryParams(params);

        this.#toggleLoading();
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
                this.#toggleLoading();
                return response.json();
            }).catch(error => {
                throw new Error('An error occurred while receiving data', error);
            });

        return response;
    }

    #toggleLoading() {
        const loadingEl = document.querySelector('.loading');
        loadingEl.classList.toggle('d-none');
    }
}

class ShowData {

    #data;
    #path;
    #currentPage;
    #lastPage;
    #keys = [];
    #links = [];
    #deleteForm;

    constructor(results) {
        this.#data = results.data;
        this.#path = results.path;
        this.#currentPage = results.current_page;
        this.#lastPage = results.last_page;
    }


    set keys(keys) {
        this.#keys = keys;
    }

    set links(links) {
        this.#links = links;
    }

    set deleteForm(form) {
        this.#deleteForm = form;
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
                td.innerHTML = record[key];
                tr.appendChild(td);
            }

            const linkTd = this.#setLinks(record.id);
            if (this.#deleteForm) {
                linkTd.innerHTML += this.#setDeleteForm(record.id);
            }
            tr.appendChild(linkTd);

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

    #setLinks(id) {
        const tdTag = document.createElement('td');
        this.#links.forEach(item => {
            const url = `${window.location.origin}/${item.url.replace(':id', id)}`;
            const anchorTag = document.createElement('a');
            anchorTag.href = url;
            anchorTag.classList.add('td-link');
            anchorTag.innerHTML = item.content;
            tdTag.appendChild(anchorTag);
        });
        return tdTag;
    }

    #setDeleteForm(id) {
        const deleteForm = `
        <form action="${this.#deleteForm.action}/${id}" class="d-inline" method="post">
            <input type="hidden" name="_token" value="${this.#deleteForm.token}">  
            <input type="hidden" name="_method" value="DELETE">                                                    
            <button type="button" onclick="deleteConfirm(this)" x-data="${id}" class="delete border-none bg-transparent text-decoration-none text-danger mr-3">حذف</button>
            <span class="d-none">
                <span class="mr-2 text-danger">حذف شود ؟!</span>
                <button type="submit" class="mr-2">بله</button>
                <button type="button" onclick="removeConfirm(this)">خیر</button>
            </span>
        </form>
        `;
        return deleteForm;
    }


}

async function cookUp(request, show) {
    const requestData = new FetchData(request.url, request.params);
    const results = await requestData.getData();
    const showData = new ShowData(results);
    showData.keys = show.dataKeys;
    showData.links = show.links;
    showData.deleteForm = show.deleteForm;
    showData.show();
}

function deleteConfirm(element) {
    const confirmElement = element.nextElementSibling;
    confirmElement.classList.remove('d-none');
    confirmElement.style.transform = "translateY(0)";
    element.classList.add('d-none');
}

function removeConfirm(element) {
    element.parentElement.classList.add('d-none');
    const removeElementItem =  element.parentElement.previousElementSibling;
    removeElementItem.classList.remove('d-none');
}