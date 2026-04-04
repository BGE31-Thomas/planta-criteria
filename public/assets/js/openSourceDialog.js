document.getElementById('openSourceModal').addEventListener('click', async () => {
    const response = await fetch('/admin/source/add');
    const html = await response.text();

    document.getElementById('modalContainer').innerHTML = html;

    document.getElementById('modal').showModal();
});