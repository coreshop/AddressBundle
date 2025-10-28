import React from 'react'
import { EntityTabbedManager } from '@coreshop/resource/src/entities'
import { useFormModal } from '@pimcore/studio-ui-bundle/components'
import { stateApi, type StateDetail } from './api'
import { StateForm } from './StateForm'

export const StateManager: React.FC = () => {
  const modal = useFormModal()

  return (
    <EntityTabbedManager<StateDetail>
      api={ stateApi }
      dragType='coreshop:state'
      leftRootTitle='States'
      localizable
      getTitle={ (li, data) => data?.name ?? li?.name ?? `#${li?.id ?? ''}` }
      buildSavePayload={ (data) => ({
        id: data.id,
        name: data.name,
        active: data.active,
        isoCode: data.isoCode,
        country: data.country,
        translations: data.translations
      }) }
      onAdd={ async () => await new Promise<number>((resolve) => {
        modal.input({
          title: 'Add State',
          label: 'Name',
          onOk: async (value: string) => {
            const res = await stateApi.add({ name: value })
            resolve(res.data.id)
          }
        })
      }) }
      renderDetail={ (data, setData, ctx) => {
        if (!data) {
          return <div style={ { padding: 12, color: 'var(--ant-color-text-tertiary)' } }>Select a state to view details.</div>
        }

        return (
          <StateForm
            data={ data }
            currentLocale={ ctx?.currentLocale ?? 'en' }
            onChange={ (draft) => setData(draft) }
          />
        )
      } }
    />
  )
}
