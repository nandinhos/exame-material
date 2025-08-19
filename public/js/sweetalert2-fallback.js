/**
 * SweetAlert2 Fallback - Versão simplificada local
 * Substitui as funcionalidades básicas do SweetAlert2 quando o CDN não está disponível
 */

// Verificar se SweetAlert2 já está carregado
if (typeof window.Swal === 'undefined') {
    // Criar objeto Swal com funcionalidades básicas
    window.Swal = {
        fire: function(options) {
            return new Promise((resolve) => {
                // Normalizar opções
                if (typeof options === 'string') {
                    options = { title: options };
                }
                
                const config = {
                    title: options.title || '',
                    text: options.text || options.html || '',
                    icon: options.icon || 'info',
                    showCancelButton: options.showCancelButton || false,
                    confirmButtonText: options.confirmButtonText || 'OK',
                    cancelButtonText: options.cancelButtonText || 'Cancelar',
                    confirmButtonColor: options.confirmButtonColor || '#3085d6',
                    cancelButtonColor: options.cancelButtonColor || '#d33'
                };
                
                // Criar modal personalizado
                const modal = this.createModal(config);
                document.body.appendChild(modal);
                
                // Focar no botão de cancelar se especificado
                if (options.focusCancel) {
                    const cancelBtn = modal.querySelector('.swal-cancel');
                    if (cancelBtn) cancelBtn.focus();
                }
                
                // Configurar eventos dos botões
                const confirmBtn = modal.querySelector('.swal-confirm');
                const cancelBtn = modal.querySelector('.swal-cancel');
                
                if (confirmBtn) {
                    confirmBtn.addEventListener('click', () => {
                        if (options.showLoaderOnConfirm) {
                            this.showLoading(modal);
                            if (options.preConfirm) {
                                options.preConfirm().then(() => {
                                    this.closeModal(modal);
                                    resolve({ isConfirmed: true });
                                });
                            } else {
                                setTimeout(() => {
                                    this.closeModal(modal);
                                    resolve({ isConfirmed: true });
                                }, 500);
                            }
                        } else {
                            this.closeModal(modal);
                            resolve({ isConfirmed: true });
                        }
                    });
                }
                
                if (cancelBtn) {
                    cancelBtn.addEventListener('click', () => {
                        this.closeModal(modal);
                        resolve({ isConfirmed: false, isDismissed: true });
                    });
                }
                
                // Fechar com ESC
                const handleKeydown = (e) => {
                    if (e.key === 'Escape') {
                        this.closeModal(modal);
                        resolve({ isConfirmed: false, isDismissed: true });
                        document.removeEventListener('keydown', handleKeydown);
                    }
                };
                document.addEventListener('keydown', handleKeydown);
                
                // Auto-close para toasts
                if (options.toast && options.timer) {
                    setTimeout(() => {
                        this.closeModal(modal);
                        resolve({ isConfirmed: false, isDismissed: true });
                    }, options.timer);
                }
            });
        },
        
        createModal: function(config) {
            const modal = document.createElement('div');
            modal.className = 'swal-modal-overlay';
            
            const iconHtml = this.getIconHtml(config.icon);
            const cancelButtonHtml = config.showCancelButton ? 
                `<button type="button" class="swal-cancel" style="background-color: ${config.cancelButtonColor}; color: white; border: none; padding: 10px 20px; margin: 0 5px; border-radius: 5px; cursor: pointer;">${config.cancelButtonText}</button>` : '';
            
            modal.innerHTML = `
                <div class="swal-modal" style="
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: white;
                    border-radius: 10px;
                    padding: 30px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                    z-index: 10000;
                    max-width: 400px;
                    width: 90%;
                    text-align: center;
                    font-family: system-ui, -apple-system, sans-serif;
                ">
                    ${iconHtml}
                    <h2 style="margin: 20px 0 10px 0; font-size: 1.5em; color: #333;">${config.title}</h2>
                    ${config.text ? `<p style="margin: 10px 0 20px 0; color: #666; line-height: 1.5;">${config.text}</p>` : ''}
                    <div class="swal-loading" style="display: none; margin: 20px 0;">
                        <div style="border: 3px solid #f3f3f3; border-top: 3px solid #3498db; border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite; margin: 0 auto;"></div>
                    </div>
                    <div class="swal-buttons" style="margin-top: 20px;">
                        ${cancelButtonHtml}
                        <button type="button" class="swal-confirm" style="background-color: ${config.confirmButtonColor}; color: white; border: none; padding: 10px 20px; margin: 0 5px; border-radius: 5px; cursor: pointer; font-weight: bold;">${config.confirmButtonText}</button>
                    </div>
                </div>
            `;
            
            // Adicionar overlay de fundo
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
            
            return modal;
        },
        
        getIconHtml: function(icon) {
            const iconStyles = {
                success: { color: '#28a745', symbol: '✓' },
                error: { color: '#dc3545', symbol: '✗' },
                warning: { color: '#ffc107', symbol: '⚠' },
                info: { color: '#17a2b8', symbol: 'ℹ' },
                question: { color: '#6f42c1', symbol: '?' }
            };
            
            const iconConfig = iconStyles[icon] || iconStyles.info;
            
            return `
                <div style="
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    background-color: ${iconConfig.color};
                    color: white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 30px;
                    font-weight: bold;
                    margin: 0 auto 10px auto;
                ">${iconConfig.symbol}</div>
            `;
        },
        
        showLoading: function(modal) {
            const buttons = modal.querySelector('.swal-buttons');
            const loading = modal.querySelector('.swal-loading');
            if (buttons) buttons.style.display = 'none';
            if (loading) loading.style.display = 'block';
        },
        
        closeModal: function(modal) {
            if (modal && modal.parentNode) {
                modal.style.opacity = '0';
                modal.style.transform = 'scale(0.8)';
                modal.style.transition = 'all 0.2s ease-out';
                setTimeout(() => {
                    if (modal.parentNode) {
                        modal.parentNode.removeChild(modal);
                    }
                }, 200);
            }
        }
    };
    
    // Adicionar CSS para animação de loading
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    console.log('SweetAlert2 fallback carregado com sucesso');
}

// Exportar para uso global
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.Swal;
}