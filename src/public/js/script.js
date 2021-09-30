function checkToken() {
    token = localStorage.getItem("token");
    tokenInput = document.getElementById("token");
    save = document.getElementById("save");
    logout = document.getElementById("logout");
    if (token) {
        console.log("token");
        logout.style.display = "block";
        tokenInput.style.display = "none";
        save.style.display = "none";
    } else {
        console.log("!token");
        logout.style.display = "none";
        tokenInput.style.display = "block";
        save.style.display = "block";
    }
}

function setToken() {
    token = document.getElementById("token");
    localStorage.setItem("token", `Bearer ${token.value}`);
    token.style.display = "none";
    logout = document.getElementById("logout");
    logout.style.display = "block";
    save = document.getElementById("save");
    save.style.display = "none";
}

function setLogout() {
    localStorage.removeItem("token");
    token = document.getElementById("token").style.display = "block";
    logout = document.getElementById("logout").style.display = "none";
    save = document.getElementById("save").style.display = "block";
}

function copyUrl(url) {
    navigator.clipboard.writeText(url);
}

function checkAuth(url, method, index, auth) {
    if (auth == true) {
        var token = localStorage.getItem("token");
        if (token) {
            getAllData(url, method, index);
            document.getElementById(`tokenmessage_${index}`).innerHTML = "";
        } else {
            document.getElementById(`tokenmessage_${index}`).innerHTML = `
                <div class="alert alert-danger" role="alert">
                Token Not Found
                </div>
            `;
            document.getElementById(`response_${index}`).innerHTML = "";
        }
    } else {
        getAllData(url, method, index);
        document.getElementById(`tokenmessage_${index}`).innerHTML = "";
    }
}

function getAllData(url, method, index) {
    let myForm = document.getElementById(`id_${index}`);
    var formData = new FormData(myForm);
    const data = {};
    for (let [key, val] of formData.entries()) {
        Object.assign(data, {
            [key]: val
        });
    }

    const params = {};
    Object.keys(data).forEach(key => {
        if (key.includes("{") == true) {
            url = url.replace(key, data[key]);
        } else {
            Object.assign(params, {
                [key]: data[key]
            });
        }
    });

    if (method == "GET") {
        axios
            .get(
                url,
                {
                    params: params
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                        accept: "application/json"
                    }
                }
            )
            .then(response => {
                document.getElementById(`response_${index}`).innerHTML =
                    `
                <span class="url-name">Response</span>
                <pre class="response">` +
                    JSON.stringify(response.data, null, 2) +
                    `</pre>
                `;
                document.getElementById(`status_${index}`).innerHTML =
                    `
                <span class="url-name">Status Code</span>
                <div class="response">` +
                    response.status +
                    `</div>
                `;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response">
                    ` +
                    url +
                    `
                <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
                </div>
                `;
            })
            .catch(error => {
                document.getElementById(`response_${index}`).innerHTML =
                    `
                <span class="url-name">Response</span>
                <pre class="response">` +
                    JSON.stringify(error.response.data, null, 2) +
                    `</pre>
                `;
                document.getElementById(`status_${index}`).innerHTML =
                    `
                <span class="url-name">Status Code</span>
                <div class="response">` +
                    error.response.status +
                    `</div>
                `;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response" onclick='copyUrl("` +
                    url +
                    `")'>` +
                    url +
                    `
                    <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
                    </div>
                `;
            });
    }

    // Post & PUT & PATCH
    if (method == "POST" || method == "PATCH" || method == "PUT") {
        var formData = new FormData();
        Object.keys(params).forEach(key => {
            formData.append(key, params[key]);
        });
        if (method !== "POST") {
            formData.append("_method", method);
        }
        this.axios
            .post(url, formData, {
                headers: {
                    "Content-Type": "application/json",
                    accept: "application/json"
                }
            })
            .then(response => {
                document.getElementById(`response_${index}`).innerHTML =
                    `<pre class="response">` +
                    JSON.stringify(response.data, null, 2) +
                    `</pre>`;
                document.getElementById(`status_${index}`).innerHTML =
                    response.status;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response">` +
                    url +
                    `
                <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
            </div>
                `;
            })
            .catch(error => {
                document.getElementById(`response_${index}`).innerHTML =
                    `<pre class="response">` +
                    JSON.stringify(error.response.data, null, 2) +
                    `</pre>`;
                document.getElementById(`status_${index}`).innerHTML =
                    error.response.status;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response">` +
                    url +
                    `
                <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
            </div>`;
            });
    }
    if (method == "DELETE") {
        this.axios
            .delete(
                url,
                {
                    params: params
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                        accept: "application/json"
                    }
                }
            )
            .then(response => {
                document.getElementById(`response_${index}`).innerHTML =
                    `<pre class="response">` +
                    JSON.stringify(response.data, null, 2) +
                    `</pre>`;
                document.getElementById(`status_${index}`).innerHTML =
                    response.status;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response">` +
                    url +
                    `
                <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
            </div>
                `;
            })
            .catch(error => {
                document.getElementById(`response_${index}`).innerHTML =
                    `<pre class="response">` +
                    JSON.stringify(error.response.data, null, 2) +
                    `</pre>`;
                document.getElementById(`status_${index}`).innerHTML =
                    error.response.status;
                document.getElementById(`fullurl_${index}`).innerHTML =
                    `
                <span class="url-name">Full URL</span>
                <div class="response">` +
                    url +
                    `
                <button class="copy-btn" onclick='copyUrl("` +
                    url +
                    `")'>Copy</button>
            </div>`;
            });
    }
}
