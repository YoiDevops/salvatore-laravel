(() => {
	const profileHeaderSelector = '[data-profile-scroll-header]';
	let profileHeaderHideTimer;
	let previousScrollPosition = window.scrollY;

	const revealProfileHeaders = () => {
		document.documentElement.removeAttribute('data-profile-header-hidden');
	};

	const hideProfileHeaders = () => {
		const hoveredHeader = document.querySelector(`${profileHeaderSelector}:hover`);
		const focusedHeader = document.activeElement?.closest(profileHeaderSelector);

		if (!hoveredHeader && !focusedHeader && window.scrollY > 80) {
			document.documentElement.setAttribute('data-profile-header-hidden', '');
		}
	};

	const scheduleProfileHeaderHide = () => {
		window.clearTimeout(profileHeaderHideTimer);
		profileHeaderHideTimer = window.setTimeout(hideProfileHeaders, 1000);
	};

	const initializeProfileHeaders = () => {
		document.querySelectorAll(profileHeaderSelector).forEach((header) => {
			if (header.dataset.profileHeaderBound) {
				return;
			}

			header.dataset.profileHeaderBound = 'true';
			header.addEventListener('pointerenter', revealProfileHeaders);
			header.addEventListener('pointerleave', () => {
				if (window.scrollY > 80) {
					scheduleProfileHeaderHide();
				}
			});
			header.addEventListener('focusin', revealProfileHeaders);
		});
	};

	const collapseInstitutionSidebar = () => {
		const sidebar = document.querySelector('.institution-sidebar');

		if (!sidebar || !window.matchMedia('(min-width: 1024px)').matches) {
			return;
		}

		if (typeof sidebar.updateDataAttributes !== 'function') {
			return;
		}

		sidebar.updateDataAttributes(sidebar);

		if (!sidebar.hasAttribute('data-flux-sidebar-collapsed-desktop')) {
			sidebar.dispatchEvent(new CustomEvent('flux-sidebar-toggle', { bubbles: true }));
		}
	};

	const initializeApplicationChrome = () => {
		initializeProfileHeaders();

		window.requestAnimationFrame(() => {
			window.requestAnimationFrame(collapseInstitutionSidebar);
		});
	};

	window.addEventListener('scroll', () => {
		const currentScrollPosition = window.scrollY;
		const scrollDelta = currentScrollPosition - previousScrollPosition;
		previousScrollPosition = currentScrollPosition;

		if (currentScrollPosition < 80 || scrollDelta < -4) {
			window.clearTimeout(profileHeaderHideTimer);
			revealProfileHeaders();
			return;
		}

		if (scrollDelta > 0) {
			scheduleProfileHeaderHide();
		}
	}, { passive: true });

	document.addEventListener('pointermove', (event) => {
		if (event.clientY <= 12) {
			window.clearTimeout(profileHeaderHideTimer);
			revealProfileHeaders();
		}
	});

	document.addEventListener('focusin', (event) => {
		if (event.target.closest(profileHeaderSelector)) {
			revealProfileHeaders();
		}
	});

	document.addEventListener('DOMContentLoaded', initializeApplicationChrome);
	document.addEventListener('livewire:navigated', initializeApplicationChrome);
	window.addEventListener('resize', collapseInstitutionSidebar);

	const syncThemeAfterNavigation = () => {
		if (typeof window.applyTheme === 'function' && typeof window.getThemePreference === 'function') {
			window.applyTheme(window.getThemePreference());
		}
	};

	window.addEventListener('pageshow', syncThemeAfterNavigation);
	window.addEventListener('popstate', syncThemeAfterNavigation);

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

	const enhanceSelectsWithin = (root) => {
		if (root instanceof HTMLSelectElement) {
			enhanceSelect(root);
			return;
		}

		root.querySelectorAll?.(nativeSelects).forEach(enhanceSelect);
	};

	const enhanceAddedNodes = (mutations) => {
		mutations.forEach(({ addedNodes }) => {
			addedNodes.forEach((node) => {
				if (node.nodeType === Node.ELEMENT_NODE) {
					enhanceSelectsWithin(node);
				}
			});
		});
	};

	const tooltipTargetSelector = [
		'a[href]',
		'button:not([disabled])',
		'[role="button"]:not([aria-disabled="true"])',
		'input:not([type="hidden"]):not([disabled])',
		'select:not([disabled])',
		'textarea:not([disabled])',
		'summary',
	].join(',');
	const contextualTooltip = document.createElement('div');
	contextualTooltip.id = 'app-contextual-tooltip';
	contextualTooltip.className = 'app-contextual-tooltip';
	contextualTooltip.setAttribute('role', 'tooltip');
	contextualTooltip.setAttribute('aria-hidden', 'true');
	contextualTooltip.hidden = true;
	let hoveredTooltipTarget = null;
	let focusedTooltipTarget = null;
	let activeTooltipTarget = null;
	let previousDescribedBy = null;

	const tooltipControlFor = (element) => {
		if (element.classList.contains('custom-select__trigger')) {
			return element.closest('.custom-select')?.querySelector('select') || element;
		}

		return element;
	};

	const tooltipLabelFor = (element) => {
		const explicitLabel = element.dataset.tooltip || element.getAttribute('aria-label') || element.getAttribute('title');
		if (explicitLabel) return explicitLabel.trim();

		const control = tooltipControlFor(element);
		if (control instanceof HTMLInputElement || control instanceof HTMLSelectElement || control instanceof HTMLTextAreaElement) {
			if (control instanceof HTMLInputElement && ['button', 'reset', 'submit'].includes(control.type)) return control.value.trim();

			const associatedLabel = Array.from(control.labels || [])
				.map((label) => label.textContent.trim())
				.find(Boolean);
			const labelledBy = control.getAttribute('aria-labelledby')
				?.split(/\s+/)
				.map((id) => document.getElementById(id)?.textContent.trim())
				.filter(Boolean)
				.join(' ');

			return associatedLabel || labelledBy || control.getAttribute('placeholder') || control.name.replace(/[_-]+/g, ' ');
		}

		return (element.textContent || '').replace(/\s+/g, ' ').trim();
	};

	const shouldShowContextualTooltip = (element, label) => {
		const normalizedLabel = label.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
		const control = tooltipControlFor(element);
		const isField = control instanceof HTMLInputElement || control instanceof HTMLSelectElement || control instanceof HTMLTextAreaElement;
		const helpfulAction = /descargar|download|exportar|export|importar|import|upload|guardar|save|actualizar|update|enviar|submit|aprobar|approve|aceptar solicitud|denegar|rechazar|deny|reject|eliminar|delete|borrar|crear|create|registrar|register|agregar|nuevo|new|add|inscripcion|solicitud|boletin|notas?|calificaciones|contraseña|password|correo|email|documento|role|rol/;

		if (element.closest('#preguntas-frecuentes, [data-flux-sidebar-brand], .institution-sidebar-brand, .institution-sidebar-collapsed-nav')) return false;
		if (element instanceof HTMLElement && element.tagName === 'SUMMARY') return false;
		if (/cambiar tema|change theme|configuracion|settings|cerrar sesion|log out|logout|sign out|abrir menu|cerrar menu|toggle sidebar|barra lateral/.test(normalizedLabel)) return false;
		if (element instanceof HTMLAnchorElement && element.closest('header nav, footer, [data-flux-sidebar-nav]')) return false;
		if (/^institucion salvatore(?:,? inicio)?$/.test(normalizedLabel)) return false;

		if (isField) {
			if (control instanceof HTMLInputElement && ['email', 'password', 'search', 'file'].includes(control.type)) return helpfulAction.test(normalizedLabel);
			if (control instanceof HTMLSelectElement) return /rol|role/.test(normalizedLabel);
			return false;
		}

		return helpfulAction.test(normalizedLabel);
	};

	const contextualTooltipText = (element) => {
		const label = tooltipLabelFor(element);
		if (!label) return '';
		if (!shouldShowContextualTooltip(element, label)) return '';
		if (element.dataset.tooltip) return element.dataset.tooltip.trim();

		const normalizedLabel = label.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().replace(/[¿?¡!.,:;]+/g, '').trim();
		const control = tooltipControlFor(element);
		const isField = control instanceof HTMLInputElement || control instanceof HTMLSelectElement || control instanceof HTMLTextAreaElement;

		if (/cambiar tema|modo claro|modo oscuro|change theme/.test(normalizedLabel)) return '';
		if (/^(ingresar|iniciar sesion|ingresar al sistema|login|log in|sign in)$/.test(normalizedLabel)) return 'Inicia sesión con tu correo y contraseña para acceder a tu cuenta.';
		if (/registrarse|sign up|conoce el proceso de inscripcion|iniciar una inscripcion/.test(normalizedLabel)) return 'Completa el formulario con los datos del estudiante y su acudiente para iniciar la inscripción.';
		if (/abrir menu|abrir menu de navegacion|abrir barra lateral|toggle sidebar/.test(normalizedLabel)) return 'Muestra el menú para que puedas ir a otra sección.';
		if (/cerrar menu|cerrar menu de navegacion|close sidebar/.test(normalizedLabel)) return 'Oculta el menú y deja más espacio para el contenido.';
		if (/contraer|colapsar barra lateral/.test(normalizedLabel)) return 'Reduce el menú lateral a sus accesos principales.';
		if (/^(inicio|home|institucion salvatore inicio)$/.test(normalizedLabel)) return 'Vuelve a la página principal de la institución.';
		if (/nuestra propuesta|propuesta educativa|explorar la propuesta/.test(normalizedLabel)) return 'Conoce cómo acompañamos el aprendizaje y el crecimiento de nuestros estudiantes.';
		if (/experiencias/.test(normalizedLabel)) return 'Descubre actividades y experiencias de nuestra comunidad educativa.';
		if (/contacto|hablemos|comunicarme/.test(normalizedLabel)) return 'Encuentra el correo y el teléfono para comunicarte con la institución.';
		if (/instagram/.test(normalizedLabel)) return 'Visita el perfil de Instagram de la institución.';
		if (/facebook/.test(normalizedLabel)) return 'Visita la página de Facebook de la institución.';
		if (/descargar solicitudes/.test(normalizedLabel)) return 'Descarga las solicitudes que estás viendo para revisarlas en Excel.';
		if (/descargar|download/.test(normalizedLabel)) return 'Guarda en tu dispositivo una copia del archivo o de la información que estás viendo.';
		if (/exportar/.test(normalizedLabel)) return 'Descarga las solicitudes que estás consultando para revisarlas en Excel.';
		if (/importar|import|cargar archivo|elegir archivo|upload|choose file/.test(normalizedLabel)) return 'Selecciona un archivo para agregar sus solicitudes al sistema.';
		if (/aprobar|aceptar solicitud|approve/.test(normalizedLabel)) {
			const solicitud = label.match(/solicitud(?:\s+de)?\s+(.+)/i);
			return solicitud
				? `Aprueba la solicitud de ${solicitud[1].trim()} para que continúe el proceso.`
				: 'Aprueba esta solicitud para que continúe el proceso.';
		}
		if (/denegar|rechazar|deny|reject/.test(normalizedLabel)) return 'Marca la solicitud como denegada para que no continúe el proceso.';
		if (/eliminar|borrar|quitar|delete|remove/.test(normalizedLabel)) return `Elimina ${label.replace(/^(eliminar|borrar|quitar|delete|remove)\s*/i, '').trim() || 'este registro'} del sistema.`;
		if (/editar|modificar|edit/.test(normalizedLabel)) return `Cambia los datos de ${label.replace(/^(editar|modificar|edit)\s*/i, '').trim() || 'este registro'}.`;
		if (/crear|agregar|nuevo|registrar|create|add|new|register/.test(normalizedLabel) && /cuenta|usuario|account|user/.test(normalizedLabel)) return 'Registra una cuenta para que la persona pueda ingresar al sistema.';
		if (/crear|agregar|nuevo|registrar/.test(normalizedLabel) && /registro de (.+)/.test(normalizedLabel)) return `Abre el formulario para registrar ${label.match(/registro de (.+)/i)?.[1] || 'la información'}.`;
		if (/crear|agregar|nuevo|registrar|create|add|new|register/.test(normalizedLabel)) return 'Abre el formulario para registrar una cuenta o un nuevo dato en el sistema.';
		if (/guardar|actualizar|enviar|save|update|submit/.test(normalizedLabel)) return 'Guarda la información que completaste para que quede registrada.';
		if (/cancelar|cancel/.test(normalizedLabel)) return 'Cancela esta acción y vuelve sin guardar los cambios.';
		if (/volver|regresar|back/.test(normalizedLabel)) return 'Regresa al listado anterior sin modificar la información.';
		if (/cerrar ventana|cerrar los detalles|cerrar$|close menu/.test(normalizedLabel)) return 'Cierra este menú y vuelve al contenido que estabas consultando.';
		if (/cerrar ventana|cerrar los detalles|cerrar$|close/.test(normalizedLabel)) return 'Cierra esta ventana y vuelve a la pantalla anterior.';
		if (/log out|logout|sign out|cerrar sesion/.test(normalizedLabel)) return 'Cierra tu sesión y vuelve a la pantalla de ingreso.';
		if (/configuracion|settings/.test(normalizedLabel)) return 'Actualiza tus datos personales y las opciones de tu cuenta.';
		if (/perfil|profile/.test(normalizedLabel)) return 'Consulta y actualiza la información de tu cuenta.';
		if (/^(siguiente|continuar|next|continue)$/.test(normalizedLabel)) return 'Guarda este paso y continúa con la siguiente parte del formulario.';
		if (/remember me/.test(normalizedLabel)) return 'Mantiene tu sesión iniciada en este dispositivo.';
		if (/mostrar u ocultar contraseña|mostrar contraseña|show.*password/.test(normalizedLabel)) return 'Muestra u oculta la contraseña mientras la escribes.';
		if (/ver detalle|ver la cuenta|ver detalles|consultar|detalle/.test(normalizedLabel)) return `Consulta la información completa de ${label.replace(/^(ver|consultar)\s*/i, '').trim() || 'este registro'}.`;
		if (/view|show/.test(normalizedLabel)) return 'Consulta los datos y detalles de este registro.';
		if (isField) {
			if (control instanceof HTMLSelectElement) {
					if (/rol|role/.test(normalizedLabel)) return 'Elige el rol que define qué secciones podrá usar esta cuenta.';
					if (/estado|status/.test(normalizedLabel)) return 'Elige si la cuenta o el registro está activo.';
				if (/curso|grado|sede|asignatura|periodo/.test(normalizedLabel)) return `Elige la opción correcta en «${label}».`;
			}
			if (control instanceof HTMLInputElement && ['checkbox', 'radio'].includes(control.type)) {
				if (/seleccionar la cuenta/.test(normalizedLabel)) return 'Marca esta casilla para incluir la cuenta en las acciones del listado.';
				return `Marca o desmarca esta opción: ${label}.`;
			}
			if (/correo|email/.test(normalizedLabel)) return 'Escribe un correo válido para recibir información o acceder a la cuenta.';
			if (/contraseña|clave|password/.test(normalizedLabel)) return 'Escribe la contraseña para esta cuenta.';
			if (/documento|identity document/.test(normalizedLabel)) return 'Escribe el número de documento tal como aparece en el documento de identidad.';
			if (/telefono|celular|phone/.test(normalizedLabel)) return 'Escribe un número de teléfono donde puedan comunicarse contigo.';
			if (/fecha|date/.test(normalizedLabel)) return 'Selecciona la fecha correspondiente.';
			if (/direccion|address/.test(normalizedLabel)) return 'Escribe la dirección de residencia.';
			if (/nombre|name/.test(normalizedLabel)) return 'Escribe el nombre de la persona tal como debe aparecer en el sistema.';
			if (control instanceof HTMLSelectElement) return `Elige la opción que corresponda a «${label}».`;
			return `Escribe aquí la información solicitada para «${label}».`;
		}
		if (/notas?|boletines?|calificaciones/.test(normalizedLabel)) return 'Consulta las notas o el boletín de evaluación del estudiante.';
		if (/^(panel administrativo|panel del administrativo)$/.test(normalizedLabel)) return 'Consulta un resumen y accesos para organizar las cuentas y la información del colegio.';
		if (/panel del docente/.test(normalizedLabel)) return 'Consulta tus cursos, estudiantes y herramientas de evaluación.';
		if (/mi informacion/.test(normalizedLabel)) return 'Consulta tu curso, tus materias y tu progreso escolar.';
		if (/estudiantes/.test(normalizedLabel)) return 'Consulta las fichas y la información de los estudiantes registrados.';
		if (/profesores|equipo docente/.test(normalizedLabel)) return 'Consulta las fichas y los datos del equipo docente.';
		if (/acudientes/.test(normalizedLabel)) return 'Consulta los datos de madres, padres y acudientes registrados.';
		if (/usuarios|cuentas/.test(normalizedLabel)) return 'Consulta y administra las cuentas y sus accesos al sistema.';
		if (/cursos/.test(normalizedLabel)) return 'Consulta los cursos y los estudiantes que pertenecen a cada grupo.';
		if (/grados/.test(normalizedLabel)) return 'Consulta los grados y su organización académica.';
		if (/asignaturas|materias/.test(normalizedLabel)) return 'Consulta las materias y las áreas de aprendizaje.';
		if (/periodos/.test(normalizedLabel)) return 'Consulta los periodos que organizan el año escolar.';
		if (/indicadores/.test(normalizedLabel)) return 'Consulta los indicadores usados para revisar el aprendizaje.';
		if (/escalas/.test(normalizedLabel)) return 'Consulta las escalas usadas para valorar el aprendizaje.';
		if (/solicitudes/.test(normalizedLabel)) return 'Revisa, filtra y consulta el estado de las solicitudes recibidas.';
		if (/roles/.test(normalizedLabel)) return 'Consulta los tipos de cuenta y los permisos que tiene cada uno.';
		if (/sedes/.test(normalizedLabel)) return 'Consulta y actualiza las sedes de la institución.';

		return '';
	};

	const hideContextualTooltip = () => {
		if (activeTooltipTarget && previousDescribedBy !== null) {
			if (previousDescribedBy) {
				activeTooltipTarget.setAttribute('aria-describedby', previousDescribedBy);
			} else {
				activeTooltipTarget.removeAttribute('aria-describedby');
			}
		}

		activeTooltipTarget = null;
		previousDescribedBy = null;
		contextualTooltip.hidden = true;
		contextualTooltip.setAttribute('aria-hidden', 'true');
	};

	const showContextualTooltip = (element) => {
		const text = contextualTooltipText(element);
		if (!text) {
			hideContextualTooltip();
			return;
		}

		if (!contextualTooltip.isConnected) document.body.appendChild(contextualTooltip);
		if (activeTooltipTarget !== element) {
			hideContextualTooltip();
			activeTooltipTarget = element;
			previousDescribedBy = element.getAttribute('aria-describedby') || '';
			const describedBy = [previousDescribedBy, contextualTooltip.id].filter(Boolean).join(' ');
			element.setAttribute('aria-describedby', describedBy);
		}

		contextualTooltip.textContent = text;
		contextualTooltip.hidden = false;
		contextualTooltip.setAttribute('aria-hidden', 'false');
		const targetBounds = element.getBoundingClientRect();
		const tooltipBounds = contextualTooltip.getBoundingClientRect();
		const left = Math.min(
			Math.max(8, targetBounds.left + (targetBounds.width - tooltipBounds.width) / 2),
			window.innerWidth - tooltipBounds.width - 8,
		);
		const above = targetBounds.top - tooltipBounds.height - 8;
		const top = above >= 8
			? above
			: Math.min(targetBounds.bottom + 8, window.innerHeight - tooltipBounds.height - 8);

		contextualTooltip.style.left = `${Math.max(8, left)}px`;
		contextualTooltip.style.top = `${Math.max(8, top)}px`;
	};

	const getTooltipTarget = (target) => {
		if (!(target instanceof Element)) return null;
		return target.closest(tooltipTargetSelector);
	};

	document.addEventListener('pointerover', (event) => {
		hoveredTooltipTarget = getTooltipTarget(event.target);
		if (hoveredTooltipTarget) showContextualTooltip(hoveredTooltipTarget);
	});

	document.addEventListener('pointerout', (event) => {
		const leavingTarget = getTooltipTarget(event.target);
		if (!leavingTarget || leavingTarget.contains(event.relatedTarget)) return;
		if (hoveredTooltipTarget === leavingTarget) hoveredTooltipTarget = null;
		if (focusedTooltipTarget) showContextualTooltip(focusedTooltipTarget);
		else hideContextualTooltip();
	});

	document.addEventListener('focusin', (event) => {
		focusedTooltipTarget = getTooltipTarget(event.target);
		if (focusedTooltipTarget) showContextualTooltip(focusedTooltipTarget);
	});

	document.addEventListener('focusout', (event) => {
		const leavingTarget = getTooltipTarget(event.target);
		if (!leavingTarget || leavingTarget.contains(event.relatedTarget)) return;
		if (focusedTooltipTarget === leavingTarget) focusedTooltipTarget = null;
		if (hoveredTooltipTarget) showContextualTooltip(hoveredTooltipTarget);
		else hideContextualTooltip();
	});

	window.addEventListener('scroll', hideContextualTooltip, true);
	window.addEventListener('resize', hideContextualTooltip);

	document.addEventListener('click', (event) => {
		document.querySelectorAll('.custom-select.is-open').forEach((container) => {
			if (!container.contains(event.target)) {
				closeSelect(container);
			}
		});
	});

	document.addEventListener('DOMContentLoaded', () => {
		enhanceVisibleSelects();
		new MutationObserver(enhanceAddedNodes).observe(document.body, {
			childList: true,
			subtree: true,
		});
	});
	document.addEventListener('livewire:navigated', enhanceVisibleSelects);
	document.addEventListener('livewire:navigated', syncThemeAfterNavigation);
})();
