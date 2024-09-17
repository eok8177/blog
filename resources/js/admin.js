import * as bootstrap from 'bootstrap'

const locale = document.querySelector('html').getAttribute('lang')

const editor_config = {
  license_key: "gpl",
  path_absolute: "/",
  selector: "textarea.tinymce",
  language: locale,
  relative_urls: false,

  plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',

  toolbar: [
    "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image media | table | lineheight outdent indent| forecolor backcolor removeformat | pagebreak anchor codesample | charmap emoticons | code fullscreen preview"
  ],

  file_picker_callback: function (callback, value, meta) {
    const x =
      window.innerWidth ||
      document.documentElement.clientWidth ||
      document.getElementsByTagName("body")[0].clientWidth;
    const y =
      window.innerHeight ||
      document.documentElement.clientHeight ||
      document.getElementsByTagName("body")[0].clientHeight;

    let cmsURL =
      editor_config.path_absolute +
      "laravel-filemanager?editor=" +
      meta.fieldname;
    if (meta.filetype == "image") {
      cmsURL = cmsURL + "&type=Images";
    } else {
      cmsURL = cmsURL + "&type=Files";
    }

    tinyMCE.activeEditor.windowManager.openUrl({
      url: cmsURL,
      title: "Filemanager",
      width: x * 0.8,
      height: y * 0.8,
      resizable: "yes",
      close_previous: "no",
      onMessage: (api, message) => {
        callback(message.content);
      },
    });
  },
};

tinymce.init(editor_config);

const getCSRFToken = () => {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

//Delete record
document.querySelectorAll('.delete').forEach(deleteButton => {
  deleteButton.addEventListener('click', function(e) {
    document.querySelector('.flash-message').innerHTML = '';
    let item = this;
    if (!item.classList.contains('not-confirm')) {
      if (!confirm('Ви впевненні, що хочете видалити?')) return false;
    }
    e.preventDefault();

    fetch(this.getAttribute("href"), {
      method: 'DELETE',
      headers: {
        'X-CSRF-Token': getCSRFToken(),
        'Content-Type': 'application/json'
      },
    })
    .then(response => response.json())
    .then(data => {
      if (data.status == 'error') {
        document.querySelector('.flash-message').innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${data.msg}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `;
      } else {
        if (!item.classList.contains('noreload')) location.reload(true);
        item.closest('.noreload-parent').remove();
      }
    });
  });
});

//Change status
document.querySelectorAll('.change-status').forEach(statusButton => {
  statusButton.addEventListener('click', function(e) {
    e.preventDefault();

    fetch(this.getAttribute("href"), {
      method: 'PUT',
      headers: {
        'X-CSRF-Token': getCSRFToken(),
        'Content-Type': 'application/json'
      },
    })
    .then(response => response.json())
    .then(data => {
      location.reload(true);
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
});
