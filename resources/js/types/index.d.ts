import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
    provider: Provider;

}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    children?: Array<NavItem>;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Provider {
    id: number;
    name: string;
    birthdate: string;
    gender?: 'male' | 'female' | null;
    occupation?: string | null;
    email: string;
    phone: string;
    pay_per_hour?: number | null;
    profile_image?: string;
    id_card?: string;
    verification_certificate?: string;
    email_verified_at?: string | null;
    password: string;
    long?: number;
    lat?: number;
    created_at: string;
    updated_at: string;
}


export interface Offer {
    id: number;
    state: int;
    service: int;
    hours: number;
    description?: string;
    long?: string;
    lat?: string;
    user_id?: number | null;
    user?: User;
    provider_id?: number | null;
    provider?: Provider;
    created_at: string;
}


export type BreadcrumbItemType = BreadcrumbItem;
