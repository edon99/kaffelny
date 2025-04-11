import { Provider, User } from '@/types';
import { ColumnDef, createColumnHelper } from '@tanstack/vue-table';

const columnHelper = createColumnHelper<User>();

export const userColumns: ColumnDef<User>[] = [
    columnHelper.group({
        header: 'User List',
        footer: props => props.column.id,
        columns: [
            columnHelper.accessor('name', {
                header: 'Name',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('email', {
                header: 'Email',
                cell: info => info.getValue(),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('email_verified_at', {
                header: 'Email Verified',
                cell: info => new Date(info.getValue()).toLocaleDateString('fr-FR'),
                footer: props => props.column.id,
            }),
            columnHelper.accessor('created_at', {
                header: 'Created At',
                cell: info => new Date(info.getValue()).toLocaleDateString('fr-FR'),
                footer: props => props.column.id,
            }),


            // Location
            columnHelper.display({
                id: 'actions',
                header:'Actions',
                cell: () => 'Actions',
            }),
        ],
    }),
];
