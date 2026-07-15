<style>
    .donate-create-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #eef2f6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        overflow: hidden;
    }
    .donate-create-card .card-accent {
        height: 4px;
        background: linear-gradient(90deg, #2d6fa3, #4a90c4, #8da83a);
    }
    .donate-create-card .card-body-inner {
        padding: 32px 36px;
    }
    .field-section {
        margin-bottom: 28px;
    }
    .field-section:last-child {
        margin-bottom: 0;
    }
    .field-section .section-title {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f1f4f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .field-section .section-title svg {
        width: 16px;
        height: 16px;
    }
    .donate-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .donate-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
    }
    .donate-grid-4 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 768px) {
        .donate-create-card .card-body-inner { padding: 20px; }
        .donate-grid-2, .donate-grid-3 { grid-template-columns: 1fr; }
    }
    .donate-field .field-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 6px;
    }
    .donate-field .field-label .required-star {
        color: #ef4444;
    }
    .donate-field .field-input {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
        color: #0f172a;
        outline: none;
    }
    .donate-field .field-input:focus {
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45, 111, 163, 0.1);
        background: #fff;
    }
    .donate-field .field-input.error {
        border-color: #ef4444;
        background: #fef2f2;
    }
    .donate-field .field-input:hover {
        background: #fff;
    }
    .donate-field .field-input::placeholder {
        color: #a0aec0;
    }
    .donate-field .field-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }
    .donate-field select.field-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 10 10'%3E%3Cpath fill='%2364748b' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 36px;
        cursor: pointer;
    }
    .donate-field .amount-wrapper {
        position: relative;
    }
    .donate-field .amount-wrapper .dollar-sign {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-weight: 600;
        font-size: 15px;
        pointer-events: none;
    }
    .donate-field .amount-wrapper .field-input {
        padding-left: 32px;
    }
    .donate-actions-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 36px;
        background: #fafbfc;
        border-top: 1px solid #eef2f6;
        flex-wrap: wrap;
        gap: 12px;
    }
    .donate-actions-bar .left-actions {
        display: flex;
        gap: 12px;
    }
    .btn-record {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 32px;
        background: linear-gradient(135deg, #2d6fa3, #1d4e7a);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(45, 111, 163, 0.2);
    }
    .btn-record:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(45, 111, 163, 0.3);
    }
    .btn-record svg { width: 18px; height: 18px; }
    .btn-cancel-create {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 11px 20px;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel-create:hover {
        color: #0f172a;
        border-color: #cbd5e1;
        background: #f8fafc;
    }
    .btn-cancel-create svg { width: 16px; height: 16px; }
    @media (max-width: 640px) {
        .donate-actions-bar { flex-direction: column; align-items: stretch; }
        .donate-actions-bar .left-actions { flex-direction: column; }
        .btn-record, .btn-cancel-create { justify-content: center; }
    }
    .status-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
    }
    .status-option:hover {
        border-color: #cbd5e1;
        background: #f1f5f9;
    }
    .status-option.active {
        border-color: #2d6fa3;
        background: #eff6ff;
        box-shadow: 0 0 0 2px rgba(45, 111, 163, 0.08);
    }
    .status-option input { display: none; }
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .status-dot.completed { background: #22c55e; }
    .status-dot.pending { background: #eab308; }
    .status-dot.failed { background: #ef4444; }
    .status-dot.refunded { background: #8b5cf6; }
    .status-label {
        font-size: 13px;
        font-weight: 500;
        color: #334155;
    }
</style>
