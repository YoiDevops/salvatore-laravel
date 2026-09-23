(() => {
	const nativeSelects = 'select:not([data-custom-select])';

	const closeSelect = (container) => {
		const trigger = container.querySelector('.custom-select__trigger');
		container.classList.remove('is-open');
		trigger?.setAttribute('aria-expanded', 'false');
	};

	const updateSelect = (select, container) => {
		const trigger = container.querySelector('.custom-select__trigger');
		const options = container.querySelectorAll('.custom-select__option');
		const selectedOption = select.options[select.selectedIndex];

		if (trigger) {
			trigger.querySelector('.custom-select__label').textContent = selectedOption?.text ?? '';
		}

		options.forEach((option, index) => {
			option.classList.toggle('is-selected', index === select.selectedIndex);
			option.setAttribute('aria-selected', String(index === select.selectedIndex));
		});
	};

	const enhanceSelect = (select) => {
		if (
			select.dataset.customSelect ||
			select.hidden ||
			select.disabled ||
			select.offsetParent === null
		) {
			return;
		}

		const container = document.createElement('div');
		container.className = 'custom-select';
		const selectStyles = getComputedStyle(select);
		container.style.setProperty('--custom-select-background', selectStyles.backgroundColor);
		container.style.setProperty('--custom-select-color', selectStyles.color);
		container.style.setProperty('--custom-select-border-color', selectStyles.borderTopColor);
		container.style.setProperty('--custom-select-border-radius', selectStyles.borderTopLeftRadius);
		container.style.setProperty('--custom-select-font-size', selectStyles.fontSize);
		container.style.setProperty('--custom-select-height', selectStyles.height);
		select.dataset.customSelect = 'native';
		select.parentNode.insertBefore(container, select);
		container.appendChild(select);

		const trigger = document.createElement('button');
		trigger.type = 'button';
		trigger.className = 'custom-select__trigger';
		trigger.setAttribute('aria-haspopup', 'listbox');
		trigger.setAttribute('aria-expanded', 'false');

		const label = document.createElement('span');
		label.className = 'custom-select__label';
		trigger.appendChild(label);

		const arrow = document.createElement('span');
		arrow.className = 'custom-select__arrow';
		arrow.setAttribute('aria-hidden', 'true');
		trigger.appendChild(arrow);

		const menu = document.createElement('div');
		menu.className = 'custom-select__menu';
		menu.setAttribute('role', 'listbox');
		menu.tabIndex = -1;

		Array.from(select.options).forEach((selectOption, index) => {
			const option = document.createElement('button');
			option.type = 'button';
			option.className = 'custom-select__option';
			option.textContent = selectOption.text;
			option.setAttribute('role', 'option');
			option.setAttribute('aria-selected', 'false');
			option.addEventListener('click', () => {
				select.selectedIndex = index;
				select.dispatchEvent(new Event('input', { bubbles: true }));
				select.dispatchEvent(new Event('change', { bubbles: true }));
				updateSelect(select, container);
				closeSelect(container);
				trigger.focus();
			});
			menu.appendChild(option);
		});

		container.append(trigger, menu);
		select.classList.add('custom-select__native');

		trigger.addEventListener('click', () => {
			const isOpen = container.classList.toggle('is-open');
			trigger.setAttribute('aria-expanded', String(isOpen));
		});

		trigger.addEventListener('keydown', (event) => {
			if (event.key === 'Escape') {
				closeSelect(container);
			}
			if (event.key === 'ArrowDown' || event.key === 'Enter' || event.key === ' ') {
				event.preventDefault();
				container.classList.add('is-open');
				trigger.setAttribute('aria-expanded', 'true');
			}
		});

		select.addEventListener('change', () => updateSelect(select, container));
		updateSelect(select, container);
	};

	const enhanceVisibleSelects = () => {
		document.querySelectorAll(nativeSelects).forEach(enhanceSelect);
	};

	document.addEventListener('click', (event) => {
		document.querySelectorAll('.custom-select.is-open').forEach((container) => {
			if (!container.contains(event.target)) {
				closeSelect(container);
			}
		});
	});

	document.addEventListener('DOMContentLoaded', () => {
		enhanceVisibleSelects();
		new MutationObserver(enhanceVisibleSelects).observe(document.body, {
			childList: true,
			subtree: true,
		});
	});
	document.addEventListener('livewire:navigated', enhanceVisibleSelects);
})();
