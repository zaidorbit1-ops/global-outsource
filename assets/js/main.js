(() => {
    const navToggle = document.querySelector('.nav-toggle');
    const navigation = document.querySelector('.primary-nav');
    const dropdownTrigger = document.querySelector('.dropdown-trigger');
    const dropdown = document.querySelector('.nav-dropdown');
    const dropdownMenu = dropdown && dropdown.querySelector('.dropdown-menu');

    if (navToggle && navigation) {
        navToggle.addEventListener('click', () => {
            const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', String(!isOpen));
            navToggle.setAttribute('aria-label', isOpen ? 'Open navigation menu' : 'Close navigation menu');
            navigation.classList.toggle('is-open', !isOpen);
            document.body.classList.toggle('menu-open', !isOpen);
        });

        navigation.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                navigation.classList.remove('is-open');
                navToggle.setAttribute('aria-expanded', 'false');
                navToggle.setAttribute('aria-label', 'Open navigation menu');
                document.body.classList.remove('menu-open');
            });
        });
    }

    if (dropdownTrigger && dropdown && dropdownMenu) {
        dropdownTrigger.addEventListener('click', () => {
            const isOpen = dropdownTrigger.getAttribute('aria-expanded') === 'true';
            dropdownTrigger.setAttribute('aria-expanded', String(!isOpen));
            dropdownMenu.classList.toggle('is-open', !isOpen);
        });

        document.addEventListener('click', (event) => {
            if (!dropdown.contains(event.target)) {
                dropdownTrigger.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.remove('is-open');
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                dropdownTrigger.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.remove('is-open');
                dropdownTrigger.focus();
            }
        });
    }

    const testimonial = document.querySelector('.testimonial-slider');
    if (testimonial) {
        const slides = [
            {
                quote: 'Global Outsource has been a valuable partner, providing reliable support for our accounting and IT needs. Their team is professional, responsive and a pleasure to work with.',
                author: 'UK Client',
                sector: 'Professional Services Firm',
            },
            {
                quote: 'The team made our day-to-day finance processes smoother and gave us dependable support as our business grew.',
                author: 'Ireland Client',
                sector: 'Growing Business',
            },
            {
                quote: 'Having one responsive team for technology and operational support has helped us stay focused on serving our customers.',
                author: 'USA Client',
                sector: 'Technology Company',
            },
        ];
        const quote = testimonial.querySelector('.testimonial-text');
        const author = testimonial.querySelector('.testimonial-author');
        const sector = testimonial.querySelector('.testimonial-sector');
        const dots = [...testimonial.querySelectorAll('.testimonial-dots button')];
        let activeSlide = 0;
        let updateTimer;

        const showSlide = (index) => {
            activeSlide = (index + slides.length) % slides.length;
            const slide = slides[activeSlide];
            const content = testimonial.querySelector('.testimonial-content');

            content.classList.add('is-changing');
            window.clearTimeout(updateTimer);
            updateTimer = window.setTimeout(() => {
                quote.textContent = slide.quote;
                author.textContent = slide.author;
                sector.textContent = slide.sector;
                dots.forEach((dot, dotIndex) => {
                    dot.setAttribute('aria-current', String(dotIndex === activeSlide));
                });
                content.classList.remove('is-changing');
            }, 180);
        };

        testimonial.querySelector('[data-testimonial-prev]').addEventListener('click', () => {
            showSlide(activeSlide - 1);
        });
        testimonial.querySelector('[data-testimonial-next]').addEventListener('click', () => {
            showSlide(activeSlide + 1);
        });
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });
    }

    const jobSelect = document.querySelector('.careers-application-form select[name="job_id"]');
    const applicationDialog = document.querySelector('.careers-application-dialog');

    if (jobSelect && applicationDialog) {
        const jobTitle = applicationDialog.querySelector('[data-application-job-title]');
        const nameInput = applicationDialog.querySelector('input[name="name"]');
        const updateApplicationTitle = () => {
            const selectedOption = jobSelect.selectedOptions[0];
            jobTitle.textContent = selectedOption && selectedOption.value ? selectedOption.textContent : 'this role.';
        };

        document.querySelectorAll('.careers-apply-link[data-job-id]').forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                jobSelect.value = link.dataset.jobId;
                updateApplicationTitle();

                if (!applicationDialog.open) {
                    applicationDialog.showModal();
                }

                nameInput.focus();
            });
        });

        jobSelect.addEventListener('change', updateApplicationTitle);
        applicationDialog.querySelector('[data-application-close]').addEventListener('click', () => applicationDialog.close());
        applicationDialog.addEventListener('click', (event) => {
            if (event.target === applicationDialog) {
                applicationDialog.close();
            }
        });

        updateApplicationTitle();
        if (applicationDialog.dataset.autoOpen === 'true') {
            applicationDialog.showModal();
            nameInput.focus();
        }
    }

    const submissionModal = document.querySelector('[data-submission-modal]');
    if (submissionModal) {
        const modalCard = submissionModal.querySelector('.submission-modal-card');
        const loadingState = submissionModal.querySelector('[data-modal-loading]');
        const resultState = submissionModal.querySelector('[data-modal-result]');
        const resultTitle = submissionModal.querySelector('[data-modal-result-title]');
        const resultMessage = submissionModal.querySelector('[data-modal-result-message]');
        const resultEyebrow = submissionModal.querySelector('[data-modal-eyebrow]');
        const resultIcon = submissionModal.querySelector('[data-modal-icon]');
        const closeButtons = [...submissionModal.querySelectorAll('[data-modal-close]')];
        let activeForm = null;
        let isSubmitting = false;
        let previousFocus = null;
        let returnDialog = null;
        let returnDialogJobId = null;
        let reopenDialogOnClose = false;

        const openModal = (form) => {
            activeForm = form;
            previousFocus = document.activeElement;
            returnDialog = form.closest('dialog');
            returnDialogJobId = returnDialog ? form.querySelector('select[name="job_id"]')?.value || null : null;
            if (returnDialog && returnDialog.open) {
                returnDialog.close();
            }
            isSubmitting = true;
            reopenDialogOnClose = false;
            modalCard.setAttribute('aria-labelledby', 'submission-modal-loading-title');
            modalCard.setAttribute('aria-describedby', 'submission-modal-loading-message');
            loadingState.hidden = false;
            resultState.hidden = true;
            submissionModal.classList.remove('is-result', 'is-error');
            closeButtons.forEach((button) => {
                button.hidden = button.classList.contains('submission-modal-close');
            });
            submissionModal.hidden = false;
            document.body.classList.add('submission-modal-open');
            modalCard.focus();
        };

        const showResult = (result) => {
            isSubmitting = false;
            reopenDialogOnClose = !result.success && returnDialog instanceof HTMLDialogElement;
            loadingState.hidden = true;
            resultState.hidden = false;
            submissionModal.classList.toggle('is-error', !result.success);
            submissionModal.classList.add('is-result');
            resultEyebrow.textContent = result.success ? 'Global Outsource' : 'Submission not completed';
            resultTitle.textContent = result.title || (result.success ? 'Thank you' : 'Please try again');
            resultMessage.textContent = result.message || 'Your submission could not be completed. Please try again.';
            modalCard.setAttribute('aria-labelledby', 'submission-modal-result-title');
            modalCard.setAttribute('aria-describedby', 'submission-modal-result-message');
            resultIcon.textContent = result.success ? '✓' : '!';
            resultIcon.setAttribute('aria-label', result.success ? 'Success' : 'Error');
            closeButtons.forEach((button) => {
                button.hidden = false;
            });

            if (result.success && activeForm) {
                activeForm.reset();
            }

            submissionModal.querySelector('.submission-modal-done').focus();
        };

        const closeModal = () => {
            if (isSubmitting) {
                return;
            }

            submissionModal.hidden = true;
            document.body.classList.remove('submission-modal-open');

            if (reopenDialogOnClose && returnDialog instanceof HTMLDialogElement) {
                returnDialog.showModal();
                returnDialog.querySelector('input[name="name"]')?.focus();
            } else if (returnDialog instanceof HTMLDialogElement) {
                const applyLink = [...document.querySelectorAll('.careers-apply-link[data-job-id]')]
                    .find((link) => link.dataset.jobId === returnDialogJobId);
                applyLink?.focus();
            } else if (previousFocus instanceof HTMLElement && !returnDialog) {
                previousFocus.focus();
            }

            activeForm = null;
            returnDialog = null;
            returnDialogJobId = null;
            reopenDialogOnClose = false;
        };

        closeButtons.forEach((button) => {
            button.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !submissionModal.hidden && !isSubmitting) {
                closeModal();
            }
        });

        document.querySelectorAll('.contact-form, .careers-application-form').forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                if (isSubmitting || !form.reportValidity()) {
                    return;
                }

                const submitButton = form.querySelector('button[type="submit"]');
                const originalButtonText = submitButton ? submitButton.innerHTML : '';
                openModal(form);

                if (submitButton) {
                    submitButton.disabled = true;
                }

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        credentials: 'same-origin',
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                    });
                    const payload = await response.json();

                    if (!response.ok || !payload.success) {
                        showResult({
                            success: false,
                            title: payload.title,
                            message: payload.message || (Array.isArray(payload.errors) ? payload.errors.join(' ') : ''),
                        });
                        return;
                    }

                    showResult(payload);
                } catch (error) {
                    showResult({
                        success: false,
                        title: 'We could not send your form',
                        message: 'There was a connection problem. Please check your internet connection and try again.',
                    });
                } finally {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    }
                }
            });
        });
    }

    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14, rootMargin: '0px 0px -36px 0px' });

        document.body.classList.add('js-reveal');
        document.querySelectorAll('[data-reveal]').forEach((element) => revealObserver.observe(element));
    }
})();
