$(function () {
    // 公共绑定模态框方法
    $('.common-bind-model').click(function () {
        let id = this.dataset.id;
        let replace = this.dataset.replace;
        let bindId = this.dataset.target;
        let ok = $(bindId).find('a.btn');
        ok[0].href = ok.attr('href').replace(replace || '__id', id);
    });
});
