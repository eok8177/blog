
const editor_config = {
  license_key: "gpl",
  path_absolute: "/",
  selector: "textarea.tinymce",
  language: 'uk',
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
