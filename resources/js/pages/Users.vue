<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, Provider, User } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { createColumnHelper, getCoreRowModel, useVueTable } from '@tanstack/vue-table';
import { ref } from 'vue';
import { userColumns } from '@/tables/userColumns';
import { providerColumns } from '@/tables/providerColumns';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';


const props = defineProps<{
    users: User[]
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

const data = ref<User[]>(props.users);
const table = useVueTable({ columns: userColumns, data, getCoreRowModel: getCoreRowModel() })
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Card className="w-full">
                        <CardHeader>
                            <CardTitle>Total Users</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{{users.length}}</div>
                            <p className="text-xs text-muted-foreground">Abser wech ha nahder bzaf a khoya</p>
                        </CardContent>
                    </Card>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <Table>
                    <TableHeader>
                        <tr v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                            <TableHead v-for="header in headerGroup.headers" :key="header.id">
                                <div v-if="!header.isPlaceholder">
                                    {{ header.column.columnDef.header }}
                                </div>
                            </TableHead>
                        </tr>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="row in table.getRowModel().rows" :key="row.id">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                {{ cell.getValue() }}
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="table.getRowModel().rows.length === 0">
                            <TableCell :colspan="providerColumns.length" class="text-center">
                                No users found.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
