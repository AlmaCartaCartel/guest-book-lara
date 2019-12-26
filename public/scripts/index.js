async function getComments(page) {
    let response = await fetch(page);

    if (!response.ok){
        throw new Error(
            `Не удалось запросить данные по адресу`
        );
    }
    let comments = document.getElementById('comments');
    comments.innerHTML = await response.text();

    paginateSet();
    applyPostId();
}

function addComment(comment){
    const allAnswers = document.querySelectorAll('.answers');
    comment.then(
        res => {
            if (res.comment_id == 0){
                document.querySelector('.comments').appendChild(createComment(res))
            }else{
                for (let elem of allAnswers){
                    let bool = false;
                    if (res.comment_id === elem.dataset.commentid){
                        if (res.parent == document.getElementById('comments').dataset.nesting){
                            bool = true;
                        }
                        const com = createComment(res, true, bool);
                        elem.appendChild(com);

                        com.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        })
                    }
                }
            }
        }
    ).then(
        () => applyPostId()
    )
}
function createComment(comment, bool = false, removebtn = false) {
    const li = document.createElement('li');
    let answer = `<button
                        class="answer btn btn-secondary"
                        data-parent="${comment.parent}"
                        data-commentid ="${comment.id}">answer</button>`;
    if (+document.getElementById('comments').dataset.nesting == comment.parent){
        answer = '';
    }

    const isNewComment = `<span class="badge badge-success">New</span>`;
    const auth = document.getElementById('comments').dataset.auth;

    console.log(auth);
    const Comment = `
        <div class="comment" >
            <h3 class="author">${comment.user_name}
                ${bool ? isNewComment: ''}
            </h3>
            <pre>${comment.message}</pre>
            <div class="d-flex justify-content-between">
                ${auth ? answer: ''}
                <span>${comment.updated_at}</span>
            </div>
        </div>
        <ul class="answers " style="list-style: none; margin-left: 30px" data-commentid="${comment.id}" >
        </ul>`;

    li.innerHTML = Comment;
    return li;
}

function applyPostId() {
    const comment_id = document.querySelector('.comment_id');
    const answers = document.querySelectorAll('.answer');
    for (let i = 0; i < answers.length; i++){
        answers[i].addEventListener('click', function () {

            comment_id.value = this.dataset.commentid;
            const blockID = 'form';
            document.getElementById(blockID).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            })
        })
    }
}
let form = document.getElementById('form');

if (form !== null){
    btn = document.getElementById('submit');
    form.addEventListener('submit',async function (event) {
        event.preventDefault();

        let response = await fetch('/comments/add',{
            method: 'POST',
            body: new FormData(this)
        });
        if (!response.ok){
            throw new Error(
                `Не удалось запросить данные по адресу`
            );
        }
        await addComment(response.json());

        document.getElementById('textarea').value = '';
        document.querySelector('.comment_id').value = '0';
    });
}

function paginateSet() {
    let paginate = document.querySelector('.pagination');

    let links = paginate.getElementsByTagName('a');

    for (let link of links){
        link.addEventListener('click', function (event) {
            event.preventDefault();
            let page = link.href;

            getComments(page);
        })
    }
}
// getComments('/comments/all?page=1');
