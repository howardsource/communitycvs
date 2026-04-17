document.addEventListener('click', (event) => {
    const toggle = event.target.closest('.accordion .accordion-toggle');
    if (!toggle) return;

    event.preventDefault();

    const section = toggle.closest('.accordion-section');
    if (!section) return;

    const contentId = toggle.getAttribute('aria-controls');
    const content = contentId ? document.getElementById(contentId) : section.querySelector('.text');

    const isOpen = section.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (content) content.hidden = !isOpen;
});

function toggleTeamMember(member) {
    const bio = member.querySelector('.bio');
    if (!bio) return;

    const isOpen = member.classList.toggle('is-open');
    member.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    bio.hidden = !isOpen;
}

document.addEventListener('click', (event) => {
    const member = event.target.closest('.team .team-member');
    if (!member) return;
    if (event.target.closest('a')) return;

    toggleTeamMember(member);
});

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Enter' && event.key !== ' ') return;

    const member = event.target.closest('.team .team-member');
    if (!member) return;

    event.preventDefault();
    toggleTeamMember(member);
});
